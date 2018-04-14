<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use TeamTNT\TNTSearch\Indexer\TNTIndexer;
use TeamTNT\TNTSearch\TNTSearch;
use App\Handlers\TokenizerHandler;

class SearchController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | 前台搜索控制器
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    /**
     * 搜索首页
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->article($request);
    }

    /**
     *
     * 参考地址：http://tnt.studio/blog/did-you-mean-functionality-with-laravel-scout
     * Github: https://github.com/teamtnt/laravel-scout-tntsearch-driver
     * @param Request $request
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function article(Request $request){
        $query = $request->input('query');
        $articles = Article::search($query)->paginate(10);

        return frontend_view('search.article', compact('articles', 'query'));
    }


}
