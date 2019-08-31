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
use Wanglelecc\Laracms\Events\BehaviorLogEvent;

/**
 * 导航模型
 *
 * Class Navigation
 * @package Wanglelecc\Laracms\Models
 */
class Navigation extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','category', 'type', 'title', 'description', 'target', 'link', 'image', 'icon', 'parent', 'path', 'params', 'order', 'is_show'];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    
    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'title';
    }
    
    /**
     * 清除缓存
     *
     * @param $id
     * @param $category
     *
     * @return bool
     */
    public static function clearCache($id, $category = 'desktop'){
        $key = 'navigation_cache_'.$category;
        \Cache::forget($key);
    
        $key = 'navigation_item_cache_'.$id;
        \Cache::forget($key);
        
        return true;
    }
    
}