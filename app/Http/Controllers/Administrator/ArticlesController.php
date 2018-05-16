<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\ArticleRequest;
use App\Handlers\CategoryHandler;
use App\Models\Category;

class ArticlesController extends Controller
{

    public function index(Article $article, Request $request)
    {
        $this->authorize('index', $article);

        // 分类过滤
        if(($category_id = $request->category ?? 0) && ($category = Category::find($category_id))){
            $article = $category->articles();
        }else{
            $article = $article->filterWith();
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
        return backend_view('article.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return backend_view('article.show', compact('article'));
    }

    public function create(Article $article, CategoryHandler $categoryHandler)
    {
        $this->authorize('create', $article);
        $category = $categoryHandler->web($categoryHandler->level($categoryHandler->getCategorys('article')), []);
        return backend_view('article.create_and_edit', compact('article','category'));
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $this->authorize('create', $article);
        $article = Article::create($request->all());
//        $category = $request->category_id ?? [];
        $article->giveCategoryTo($request->category_id ?? []);
//        $article->categorys()->saveMany($category);
        return redirect()->route('articles.index')->with('success', '添加成功.');
    }

    public function edit(Article $article, CategoryHandler $categoryHandler)
    {
        $this->authorize('update', $article);
        $articleCategorys = $article->categorys()->pluck('category_id')->toArray();
        $category = $categoryHandler->web($categoryHandler->level($categoryHandler->getCategorys('article')), $articleCategorys);
        return backend_view('article.create_and_edit', compact('article', 'category'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        $article->update($request->all());
        $article->syncCategory($request->category_id ?? []);
        return redirect()->route('articles.index')->with('success', '更新成功.');
    }

    public function destroy(Article $article)
    {
        $this->authorize('destroy', $article);
        $article->delete();
        return redirect()->route('articles.index')->with('success', '删除成功.');
    }

    public function order(Article $article){
        $this->authorize('update', $article);
        $ids = request('id',[]);
        $order = request('order',[]);

        foreach($ids as $k => $id){
            $article->where('id',$id)->update(['order' => $order[$k] ?? 999 ]);
        }

        return redirect()->route('articles.index')->with('success', '操作成功.');
    }
}