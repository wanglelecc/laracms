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

namespace App\Models;

use Illuminate\Support\Facades\Storage;

/**
 * 文件模型
 *
 * Class File
 * @package App\Models
 */
class File extends Model
{
    protected $fillable = ['id','type', 'path', 'mime_type', 'md5', 'title', 'folder', 'object_id', 'size', 'width', 'height', 'downloads', 'public', 'editor', 'status', 'created_op'];

    public function getImageUrl(){
        return $this->path ? Storage::url($this->path) : config('app.url') . '/images/pic-none.png';
    }
}
