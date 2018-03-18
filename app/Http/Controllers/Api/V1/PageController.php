<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Transformers\PageTransformer;
use App\Models\Page;

class PageController extends Controller
{
    // 页面详情
    public function show($page_id = 0)
    {
        $page = Page::where('id', intval($page_id))->where('status', '1')->first();
        if(!$page->id){ abort(404); }
        return $this->response->item($page, new PageTransformer());
    }

    // 关于我们
    public function about(){
        return $this->response->array(['content' => config("system.common.company.content") ]);
    }
}
