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

namespace Wanglelecc\Laracms\Models;

use Illuminate\Support\Facades\Storage;

/**
 * 分类模型
 *
 * Class Category
 * @package Wanglelecc\Laracms\Models
 */
class MultipleFile extends Model
{
    protected $table = 'multiple_files';
    protected $fillable = ['id','multiple_file_table_id', 'multiple_file_table_type', 'field', 'order', 'path', ];

    public function multiple_file_table(){
        return $this->morphTo();
    }

    public function file()
    {
        return $this->hasOne('Wanglelecc\Laracms\Models\File', 'path', 'path');
    }

    public function toArray()
    {
        $array = [
            'id'        => $this->id,
            'field'     => $this->field,
            'order'     => $this->order,
            'path'      => $this->path,

            'name'     => $this->file->title,
            'folder'    => $this->file->folder,
            'size'      => $this->file->size,
            'origSize'  => $this->file->size,
            'type'      => $this->file->mime_type,
        ];

        if($this->file->type == 'image'){
            $array['previewImage']  = $array['url'] = storage_image_url($this->path);
        }else{
            $array['url'] = storage_url($this->path);
        }

        return $array;
    }

}