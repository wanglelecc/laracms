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
use Wanglelecc\Laracms\Models\Category;
use Wanglelecc\Laracms\Models\Navigation;

/**
 * 文章控制器
 *
 * Class ArticleController
 * @package Wanglelecc\Laracms\Http\Controllers
 */
class ArticleController extends Controller
{

    /**
     * 分类
     *
     * @param int $navigation
     * @param Category $articleCategory
     * @param Article $article
     * @return mixed
     */
    public function category($navigation = 0, Category $articleCategory, Article $article)
    {
        $category = $articleCategory;
        $articles = [];
        $articles = $articleCategory->articles()->ordered()->recent()->paginate(10);

        return frontend_view('category.'.$articleCategory->getTemplate('index'), compact('navigation','category','articles'));
    }

    /**
     * 列表
     *
     * @param int $navigation
     * @param Category $articleCategory
     * @param Article $article
     * @return mixed
     */
    public function index($navigation = 0, Category $articleCategory, Article $article)
    {
        $category = $articleCategory;
        $articles = $category->articles()->active()->ordered()->recent()->paginate(10);

        return frontend_view('article.'.$articleCategory->getTemplate('list'), compact('navigation','category','articles'));
    }

    /**
     * 详情
     *
     * @param int $navigation
     * @param int $category
     * @param Article $safeArticle
     * @return mixed
     */
    public function show($navigation = 0, $category = 0, Article $safeArticle)
    {
        $article = $safeArticle;
        $article->increment('views');

        return frontend_view('article.'.$article->getTemplate($category), compact('article'));
    }

}
