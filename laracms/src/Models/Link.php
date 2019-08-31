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
use Wanglelecc\Laracms\Events\BehaviorLogEvent;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 友情链接模型
 *
 * Class Link
 * @package Wanglelecc\Laracms\Models
 */
class Link extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['id','name', 'description', 'url', 'order', 'rating', 'image', 'target', 'rel', 'status'];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'name';
    }

    /**
     * 追加过滤条件
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }
}
