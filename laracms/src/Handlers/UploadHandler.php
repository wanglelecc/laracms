<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

namespace Wanglelecc\Laracms\Handlers;

use Image;
use Illuminate\HTTP\File;
use Illuminate\Support\Facades\Storage;
use Wanglelecc\Laracms\Models\File as FileModel;

/**
 * 文件上传工具类
 *
 * Class UploadHandler
 * @package Wanglelecc\Laracms\Handlers
 */
class UploadHandler
{

    /**
     * 检查分片是否存在
     *
     * @param $guid
     * @param $md5
     * @param $chunk
     * @return mixed
     */
    public function checkChunk($guid, $md5, $chunk){
        $md5 = strtolower($md5);

        // 构建分片文件名
        $filename = "chunks/{$md5}/{$chunk}.part";

        return Storage::disk('local')->exists($filename);
    }
    
    /**
     * 保存上传的文件分片
     *
     * @param $guid 整体文件的 guid
     * @param $md5 整体文件的 MD5 值
     * @param $file
     * @param $chunk
     *
     *  @return mixed
     */
    public function saveUploadChunk($guid, $md5, $file, $chunk){
        $md5 = strtolower($md5);

        // 构建分片目录
        $tmp_chunks_directory = "chunks/{$md5}";
        
        return Storage::disk('local')->putFileAs($tmp_chunks_directory, $file, "{$chunk}.part");
    }
    
    /**
     * 合并分片文件并保存到文件系统记录入库
     *
     * @param $guid
     * @param $md5
     * @param $chunks
     * @param $originalName
     * @param $mimeType
     * @param $extension
     * @param $type
     * @param $object_id
     * @param $folder
     * @param $editor
     *
     * @return array|bool
     */
    public function mergeChunks($guid, $md5, $chunks, $originalName, $mimeType, $extension, $type, $object_id, $folder, $editor){

        $md5            = strtolower($md5);
        $type           = strtolower($type);
        $extension      = strtolower($extension);
        $originalName   = strtolower($originalName);

        // 检查文件后缀是否是规则允许后缀
        if ( ! in_array($extension, config('filesystems.uploader.'.$type.'.allowed_ext')) ) {
            return false;
        }

        // 检查文件是否已上传过
        if($fileModel = $this->checkFile($md5, $type, $folder)){
            return [
                'id'    => $fileModel->id,
                'path'  => $fileModel->path,
                'url'   => $type == 'image' ? storage_image_url($fileModel->path) : storage_url($fileModel->path),
            ];
        }

        // 获取本地 Storage 实例
        $storage = Storage::disk('local');

        // 构建分片目录
        $directory = "chunks/{$md5}";
        $directories = $storage->files($directory);

        // 分片数目不对
        if( count($directories) !== intval($chunks) ){
            return false;
        }

        // 临时设置响应超时时间
        set_time_limit(0);

        // 合并文件
        $filename = 'chunks/' . $md5 . '.' . $extension;
        $filenamePath = $storage->path($filename);
        $storage->delete($filename);
        $directoryPath = $storage->path($directory);

        $fp = fopen($filenamePath, "ab");
        for($i = 0; $i < $chunks; $i++ ){
            $partFilenamePath = $directoryPath. '/'. $i . '.part';
            $handle = fopen($partFilenamePath, "rb");
            fwrite($fp, fread($handle, filesize($partFilenamePath)));
            fclose($handle);
            unset($handle);
            unset($partFilenamePath);
        }
        fclose($fp);

        // 计算合并后文件的 MD5 值进行校验
        if( $md5 !== md5_file($filenamePath) ){
            // MD5 校验失败
            return false;
        }

        // 获取文件大小
        $size = filesize($filenamePath);

        // 实例化 Image 对象
        if($type == 'image'){
            $image = Image::make($storage->path($filename));
            $width = $image->width();
            $height = $image->height();
        }else{
            // 文件无宽度属性。默认 0
            $width = 0;
            $height = 0;
        }

        // 构建存储的文件夹规则，值如：images/avatars/201709/21/
        $folderName = $type."s/$folder/" . date("Ym", time()) . '/'.date("d", time());

        // 将合并后的文件移动到我们的目标存储路径中 或 云存储中
        if( ! ( $path = Storage::putFile($folderName, new File($storage->path($filename)), 'public') ) ) {
            return false;
        }

        // 将文件信息记录到数据库
        if($result = $this->saveFile($object_id, $type, $path, $mimeType, $md5, $originalName, $folder, $size, $width, $height, $editor)){

            # 删除临时分片信息
            $storage->delete($filename);
            $storage->deleteDirectory($directory);

            # 所有信息准备完毕，返回文件信息
            return [
                'id'    => $result->id,
                'path'  => $path,
                'url'   => $type == 'image' ? storage_image_url($result->path) : storage_url($result->path),
            ];
        }

        return false;
    }
    
    /**
     * 保存上传文件
     *
     * @param $type
     * @param $object_id
     * @param $file
     * @param $folder
     * @param $editor
     *
     * @return array|bool
     */
    public function saveUploadFile($type, $object_id, $file, $folder, $editor)
    {
        $type = strtolower($type);
        
        // 构建存储的文件夹规则，值如：images/avatars/201709/21/
        $folder_name = $type."s/$folder/" . date("Ym", time()) . '/'.date("d", time());
        
        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ? : 'png';

        // 检查文件后缀是否是规则允许后缀
        if ( ! in_array($extension, config('filesystems.uploader.'.$type.'.allowed_ext')) ) {
            return false;
        }
    
        // 原始文件名
        $title = $file->getClientOriginalName();
    
        // 获取文件的 Mime
        $mimeType = $file->getClientMimeType();
        
        // 获取文件大小
        $size = $file->getSize();
        
        // 获取文件 MD5 值
        $md5 = md5_file($file->getPathname());
       
        // 检查文件是否已上传过
        if($fileModel = $this->checkFile($md5, $type, $folder)){
            return [
                'id'    => $fileModel->id,
                'path'  => $fileModel->path,
                'url'   => $type == 'image' ? storage_image_url($fileModel->path) : storage_url($fileModel->path),
            ];
        }
    
        // 实例化 Image 对象
        if($type == 'image'){
            $image = Image::make($file->getPathname());
            $width = $image->width();
            $height = $image->height();
        }else{
            // 文件无宽度属性。默认 0
            $width = 0;
            $height = 0;
        }
        
        // 将图片移动到我们的目标存储路径中 或 云存储中
        if( ! ( $path = $file->store($folder_name)) ) {
            return false;
        }
        
        // 将文件信息记录到数据库
        if($result = $this->saveFile($object_id, $type, $path, $mimeType, $md5, $title, $folder, $size, $width, $height, $editor)){
            return [
                'id'    => $result->id,
                'path'  => $path,
                'url'   => $type == 'image' ? storage_image_url($result->path) : storage_url($result->path),
            ];
        }else{
            Storage::delete($path);
        }
    
        return false;
    }

    /**
     * 剪裁图片
     *
     * @param $image
     * @param $max_width
     * @return array
     */
    public function reduceSize($image, $max_width)
    {
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($image);

        // 进行大小调整的操作
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        return [ 'data' => $image->encode(pathinfo($image->basePath(), PATHINFO_EXTENSION)), 'image' => $image ];
    }

    /**
     * 检查文件是否已存在
     *
     * @param $md5
     * @return mixed
     */
    public function checkFile($md5, $type, $folder){
        return FileModel::where('md5','=',$md5)->where('type','=',$type)->first();
    }

    /**
     * 保存文件
     *
     * @param $object_id
     * @param $type
     * @param $path
     * @param $mimeType
     * @param $md5
     * @param $title
     * @param $folder
     * @param $size
     * @param $width
     * @param $height
     * @param $editor
     * @return mixed
     */
    public function saveFile($object_id, $type, $path, $mimeType, $md5, $title, $folder, $size, $width, $height, $editor = 0, $status = 1, $storage_id = null, $disks = null){
        return FileModel::create([
            'storage_id' => $storage_id,
            'object_id' => $object_id,
            'type' => $type,
            'disks' => $disks ?: config('filesystems.default'),
            'path' => $path,
            'mime_type' => $mimeType,
            'md5' => $md5,
            'title' => $title,
            'folder' => $folder,
            'size' => $size,
            'width' => $width,
            'height' => $height,
            'editor' => (string)$editor,
            'status' => (string)$status,
        ]);
    }

}