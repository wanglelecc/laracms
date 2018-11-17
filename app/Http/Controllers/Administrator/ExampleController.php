<?php

/**
 * 后台示例控制器
 */
namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;

class ExampleController extends Controller
{

    public function __construct()
    {
        static::$activeNavId = 'dashboard';
    }

    public function index(){
        return laravel_backend_view('example');
    }
}
