<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Navigation;

class PageController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | 页面控制器
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    /**
     * 页面详情
     *
     * @param int $navigation
     * @param Page $safePage
     * @return mixed
     */
    public function show($navigation = 0, Page $safePage)
    {
        $page = $safePage;
        $page->increment('views');
        return frontend_view('page.'.$page->getTemplate(), compact('page'));
    }
}
