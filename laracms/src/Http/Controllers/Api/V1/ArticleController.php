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

namespace Wanglelecc\Laracms\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Wanglelecc\Laracms\Http\Controllers\Api\Controller;
use Wanglelecc\Laracms\Transformers\ArticleTransformer;
use Wanglelecc\Laracms\Models\Article;
use Wanglelecc\Laracms\Models\Category;

/**
 * 文章控制器
 *
 * Class ArticleController
 * @package Wanglelecc\Laracms\Http\Controllers\Api\V1
 */
class ArticleController extends Controller
{
    /**
     * 列表
     *
     * @param int $category_id
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function index($category_id = 0, Request $request)
    {
        if( ! ($category = Category::find($category_id)) ){ abort(404); }

        $articles = $category->articles();
        $articles = $articles->ordered()->recent()->paginate(10);

        return $this->response->paginator($articles, new ArticleTransformer());
    }
}
