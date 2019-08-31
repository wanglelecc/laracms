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
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 文件模型
 *
 * Class File
 * @package Wanglelecc\Laracms\Models
 */
class File extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','type', 'disks', 'path', 'mime_type', 'md5', 'title', 'folder', 'object_id', 'storage_id', 'size', 'width', 'height', 'downloads', 'public', 'editor', 'status', 'created_op'];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
}
