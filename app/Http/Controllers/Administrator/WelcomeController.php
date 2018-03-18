<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class WelcomeController extends Controller
{
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
