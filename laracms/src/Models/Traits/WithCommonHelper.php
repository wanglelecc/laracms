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

use Carbon\Carbon;
use Cache;
use DB;
use Wanglelecc\Laracms\Models\Category;
use Illuminate\Support\Facades\Storage;

/**
 * 模型公共功能方法
 *
 * Trait WithCommonHelper
 * @package Wanglelecc\Laracms\Models\Traits
 */
trait WithCommonHelper
{

    /**
     * 获取模板
     *
     * @param int $category
     * @return string
     */
    public function getTemplate($category = 0){
        $template = 'show';

        if($this->template){
            $template = $template . '-' . strtolower($this->template);
        }else if( $category && ($category = Category::show($category,'article')) && $category->template ){
            $template = $template . '-' . strtolower($category->template);
        }

        return $template;
    }
    
    /**
     * 获取作者
     *
     * @param $value
     *
     * @return string
     */
    public function getAuthorAttribute($value){
        return empty($value) ? '管理员' : $value;
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
