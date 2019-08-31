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

namespace Wanglelecc\Laracms\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use Auth;

/**
 * Welcome 控制器
 *
 * Class WelcomeController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class WelcomeController extends Controller
{
    
    public function __construct()
    {
        static::$activeNavId = 'dashboard';
    }
    
    /**
     * 仪表盘
     * @return mixed
     */
    public function dashboard(){
        return backend_view("dashboard");
    }

    public function permissionDenied(){
        // 如果当前用户有权限访问后台，直接跳转访问
        if (Auth::user()->can('manage_system')) {
            //return redirect()->route('administrator.dashboard')->status(302);
        }

        // 否则使用视图
        return backend_view('permission_denied');
    }
}
