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

use DB;
use Wanglelecc\Laracms\Models\Article;
use Illuminate\Http\Request;
use Wanglelecc\Laracms\Http\Requests\Administrator\ArticleRequest;
use Wanglelecc\Laracms\Handlers\CategoryHandler;
use Wanglelecc\Laracms\Models\Category;
use Wanglelecc\Laracms\Models\MultipleFile;

/**
 * 后台文章管理控制器
 *
 * Class ArticlesController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class ArticlesController extends Controller
{
    public function __construct(Request $request)
    {
        $type = isset($request->type) ?  '.'.$request->type : '';
        static::$activeNavId = 'content.article'.$type;
    }

    /**
     * 列表
     *
     * @param Article $article
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Article $article, Request $request, CategoryHandler $categoryHandler)
    {
        $this->authorize('index', $article);

        // 分类过滤
        if(($category_id = $request->category ?? 0) && ($category = Category::find($category_id))){
            $article = $category->articles();
        }

        $article = $article->with(['categorys']);

        // 关键字过滤
        if($keyword = $request->keyword ?? ''){
            $article->where('title', 'like', "%{$keyword}%");
        }

        // 开始时间过滤
        if($begin_time = $request->begin_time ?? ''){
            $article = $article->where('created_at','>',$begin_time);
        }

        // 结束时间过滤
        if($end_time = $request->end_time ?? ''){
            $article = $article->where('created_at','<',$end_time);
        }

        $articles = $article->ordered()->recent()->paginate(config('administrator.paginate.limit'));

        // 修正页码
        if( $articles->count() < 1 && $articles->lastPage() > 1 ){
            return redirect($articles->url($articles->lastPage()));
        }

        // 文章分类
        $category = $categoryHandler->select($categoryHandler->getCategorys('article'));

        return backend_view('article.index', compact('articles', 'category', 'category_id'));
    }

    /**
     * 详情
     *
     * @param Article $article
     * @return mixed
     */
    public function show(Article $article)
    {
        return backend_view('article.show', compact('article'));
    }

    /**
     * 创建
     *
     * @param Article $article
     * @param CategoryHandler $categoryHandler
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Article $article, CategoryHandler $categoryHandler)
    {
        $this->authorize('create', $article);
        
        $category = $categoryHandler->web($categoryHandler->select($categoryHandler->getCategorys('article')), []);

        return backend_view('article.create_and_edit', compact('article','category'));
    }

    /**
     * 保存
     *
     * @param ArticleRequest $request
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ArticleRequest $request, Article $article)
    {
        $this->authorize('create', $article);
        $article = Article::create($request->all());
        $article->giveCategoryTo($request->category_id ?? []);

        return $this->redirect('articles.index')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param Article $article
     * @param CategoryHandler $categoryHandler
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Article $article, CategoryHandler $categoryHandler)
    {
        $this->authorize('update', $article);
        $articleCategorys = $article->categorys()->pluck('category_id')->toArray();
        $category = $categoryHandler->web($categoryHandler->select($categoryHandler->getCategorys('article')), $articleCategorys);

        return backend_view('article.create_and_edit', compact('article', 'category'));
    }

    /**
     * 更新
     *
     * @param ArticleRequest $request
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        $article->update($request->all());
        $article->syncCategory($request->category_id ?? []);

        return $this->redirect('articles.index')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Article $article)
    {
        $this->authorize('destroy', $article);
        $article->delete();
        $article->categorys()->detach();

        return $this->redirect()->with('success', '删除成功.');
    }

    /**
     * 批量删除
     *
     * @param Article $article
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroyAll(Article $article, Request $request)
    {
        $this->authorize('destroy', $article);

        $checkid = $request->checkid;

        if(empty($checkid)){
            return $this->redirect()->with('danger', '参数错误.');
        }

        if($article->whereIn('id', $checkid)->delete()){
            DB::table('article_category')->whereIn('article_id', $checkid)->delete();
            return $this->redirect()->with('success', '批量删除成功.');
        }else{
            return $this->redirect()->with('danger', '批量删除失败.');
        }
    }

    /**
     * 排序
     *
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function order(Article $article){
        $this->authorize('update', $article);
        $ids = request('id',[]);
        $order = request('order',[]);

        foreach($ids as $k => $id){
            $article->where('id',$id)->update(['order' => $order[$k] ?? 999 ]);
        }

        return redirect()->route('articles.index')->with('success', '操作成功.');
    }

    /**
     * 多文件列表
     *
     * @param Article $article
     * @param $field
     * @return mixed|null
     */
    public function multipleFiles(Article $article, $field){
        if( method_exists($article, $field = strtolower($field)) ){
            $$field = $article->$field;
            return backend_view('article.'.$field, compact('article', $field));
        }else{
            return null;
        }
    }

    /**
     * 多文件保存
     *
     * @param Article $article
     * @param $field
     * @param Request $request
     * @return mixed
     */
    public function multipleFilesStore(Article $article, $field, Request $request){
        $multiple_files = $request->multiple_files;
        if( method_exists($article, $field = strtolower($field)) ){
            return $article->syncMultipleFiles($multiple_files, $field);
        }

        return false;
    }

    /**
     * 删除文件
     *
     * @param Article $article
     * @param $field
     * @param MultipleFile $multipleFile
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function multipleFilesDestroy(Article $article, $field, MultipleFile $multipleFile, Request $request){
        $multipleFile->delete();
        return [];
    }
    
    /**
     * 多文件排序
     *
     * @param Article $article
     * @param         $field
     * @param Request $request
     *
     * @return array
     */
    public function multipleFilesOrder(Article $article, $field, Request $request){
        $params = $request->params ?? [];
        
        foreach($params as $param){
            MultipleFile::where('id', intval($param['id']))->update(['order' => intval($param['order'])]);
        }
        
        return [];
    }

}