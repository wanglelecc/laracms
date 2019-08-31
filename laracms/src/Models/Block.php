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

/**
 * 区块模型
 *
 * Class Block
 * @package Wanglelecc\Laracms\Models
 */
class Block extends Model
{
    protected $fillable = ['id','type', 'object_id', 'title', 'template', 'icon', 'more_title', 'more_link', 'content','created_op','updated_op'];

    public function getRouteKeyName()
    {
        return 'id';
    }
    
    /**
     * 清除缓存
     *
     * @param $object_id
     *
     * @return bool
     */
    public static function clearCache($object_id){
        $key = 'block_cache_'.$object_id;
    
        \Cache::forget($key);
    
        return true;
    }
}
