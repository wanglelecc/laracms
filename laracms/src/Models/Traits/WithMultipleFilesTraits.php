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

namespace Wanglelecc\Laracms\Models\Traits;

use Wanglelecc\Laracms\Models\MultipleFile;

trait WithMultipleFilesTraits{

    /**
     * 获取多文件
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function multiple_files(){

        $morphMany = $this->morphMany('Wanglelecc\Laracms\Models\MultipleFile', 'multiple_file_table');

        list($one, $caller) = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

        $field = $caller['function'];

        if( $field && is_string($field) ){
            $morphMany->where('field', '=', $field)->orderBy('order');
        }

        return $morphMany;
    }


    /**
     * 同步多图
     *
     * @param $multipleFiles
     * @param $field
     * @return $this
     */
    public function syncMultipleFiles($multipleFiles, $field)
    {
        // 清空多图保存数据
        $this->$field()->delete();

        return $this->giveMultipleFilesTo($multipleFiles, $field);
    }

    /**
     * 添加附件
     *
     * @param $multipleFiles
     * @param $field
     * @return WithMultipleFilesTraits
     */
    public function addMultipleFiles($multipleFiles, $field){

        $multipleFiles = (array)$multipleFiles;

        $files = $this->$field()->get();
        foreach($files as $file){
            $key = array_search($file->path, $multipleFiles);
            if( is_integer($key) ){
                unset($multipleFiles[$key]);
            }
        }
        return empty($multipleFiles) ? null : $this->giveMultipleFilesTo( (array)$multipleFiles, $field );
    }

    /**
     * 遍历生成多图 Model 对象
     *
     * @param $multipleFiles
     * @param $field
     * @return $this
     */
    public function giveMultipleFilesTo($multipleFiles, $field)
    {
        $multipleFiles = collect($multipleFiles)
            ->flatten()
            ->map(function ($multipleFile, $order) use ($field) {
                return $this->getStoredMultipleFile($multipleFile, $field, $order);
            })
            ->all();

        $this->multiple_files()->saveMany($multipleFiles);

        return $this;
    }

    /**
     * 生成多图 Model 对象
     *
     * @param $multipleFile
     * @param $field
     * @param $order
     * @return \Wanglelecc\Laracms\Models\MultipleFile
     */
    public function getStoredMultipleFile($multipleFile, $field, $order){
        return new MultipleFile([
            'field' => strtolower($field),
            'order' => intval($order),
            'path' => $multipleFile,
        ]);
    }
}