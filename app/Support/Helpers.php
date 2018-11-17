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

use Illuminate\Support\Arr;
use Illuminate\Support\Str;


if( !function_exists("laravel_frontend_view") ){
    /**
     * 前台 view 加载函数
     *
     * @author lele.wang <lele.wang@raiing.com>
     * @param $name
     * @return mixed
     */
    function laravel_frontend_view($name)
    {

        // 注册模板变量
        $theme = is_mobile() ? config('theme.mobile') : config('theme.desktop');

        $args = func_get_args();
        $args[0] = 'frontend.'.$theme.'.'.$name;

        return view(...$args);
    }

    /**
     * 后台 view 加载函数
     * @param $name
     * @return mixed
     */
    function laravel_backend_view($name)
    {
        $args = func_get_args();
        $args[0] = 'backend.'.$name;

        return view(...$args);
    }
}

