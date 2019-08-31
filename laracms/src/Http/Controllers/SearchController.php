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

namespace Wanglelecc\Laracms\Http\Controllers;

use Illuminate\Http\Request;
use Wanglelecc\Laracms\Models\Article;
use TeamTNT\TNTSearch\Indexer\TNTIndexer;
use TeamTNT\TNTSearch\TNTSearch;
use Wanglelecc\Laracms\Handlers\TokenizerHandler;

/**
 * 前台搜索控制器
 *
 * Class SearchController
 * @package Wanglelecc\Laracms\Http\Controllers
 */
class SearchController extends Controller
{

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
