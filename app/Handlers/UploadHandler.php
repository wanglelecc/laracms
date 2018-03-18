<?php
/**
 * Created by PhpStorm.
 * User: lele.wang
 * Date: 2018/1/31
 * Time: 23:03
 */

namespace App\Handlers;

use Image;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class UploadHandler
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function saveImage($object_id, $file, $folder, $editor, $file_prefix, $max_width = false)
    {
        $type = 'image';
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        $folder_name = "images/$folder/" . date("Ym", time()) . '/'.date("d", time());

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
//        $upload_path = public_path() . '/' . $folder_name;
        $upload_path = $folder_name;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        // 如果上传的不是图片将终止操作
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        $title = $file->getClientOriginalName(); // 原始文件名
        $mimeType = $file->getClientMimeType(); // 获取文件的 Mime
        $size = $file->getSize();

        // 将图片移动到我们的目标存储路径中
        // $file->move($upload_path, $filename);
        if( ! ($path = $file->store($folder_name)) ) {
            return false;
        }

        $md5 = md5(Storage::get($path));
        // 检查文件是否已上传过
        if($fileModel = $this->checkFile($md5,$type,$folder)){
            Storage::delete($path);
            return ['uri' => $fileModel->path, 'path' => Storage::url($fileModel->path)];
        }

        // 实例化 Image 对象
        $image = Image::make(Storage::get($path));
        $width = $image->width();
        $height = $image->height();


        // 如果限制了图片宽度，就进行裁剪
        if ($max_width && $extension != 'gif') {
            // 此类中封装的函数，用于裁剪图片
            $reduceResult = $this->reduceSize($image, $max_width);

            // 再次检查
            if($fileModel = $this->checkFile($newMd5 = md5($reduceResult['data']),$type,$folder)){
                // 如果存在，删除已保存的图片，使用已有图片
                Storage::delete($path);
                return ['uri' => $fileModel->path, 'path' => Storage::url($fileModel->path)];
            }else{
                // 如果不存在，重新覆盖 md5, width, width
                Storage::put($path, $reduceResult['data']); // 重新保存

                $md5 = $newMd5;
                $width = $reduceResult['image']->width();
                $height = $reduceResult['image']->height();
                $size = Storage::size($path);
            }
        }

        // 保存
        if($this->saveFile($object_id, $type, $path, $mimeType, $md5, $title, $folder, $size, $width, $height, $editor)){
            return ['uri' => $path, 'path' => Storage::url($path)];
        }else{
            Storage::delete($path);
            return false;
        }
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
    public function checkFile($md5,$type,$folder){
        return File::where('md5','=',$md5)->where('type','=',$type)->where('folder','=',$folder)->first();
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
    public function saveFile($object_id, $type, $path, $mimeType, $md5, $title, $folder, $size, $width, $height, $editor = 0){
        return File::create([
            'object_id' => $object_id,
            'type' => $type,
            'path' => $path,
            'mime_type' => $mimeType,
            'md5' => $md5,
            'title' => $title,
            'folder' => $folder,
            'size' => $size,
            'width' => $width,
            'height' => $height,
            'editor' => (string)$editor,
        ]);
    }

}