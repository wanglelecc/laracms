<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ArticleObserver
{
    public function creating(Article $article)
    {
//        $article->object_id = create_object_id();
        $article->status = '1';
        $article->order = 9999;
        $article->created_op || $article->created_op = Auth::id();
        $article->updated_op || $article->updated_op = Auth::id();

        $content = clean($article->content, 'user_body');

        // 生成文章摘录
        $article->description = make_excerpt($content);
    }

    public function updating(Article $article)
    {
        $article->updated_op = Auth::id();
    }

    public function saving(Article $article){
        $article->type = 'article';

        // XSS 过滤
        $article->content = clean($article->content, 'user_body');
    }

    public function saved(Article $article){
//        $article->categorys()->detach();
//        dump($article->category_id); exit;
//        $article->categorys()->sync($article->category_id);
    }

    public function deleted(Article $article)
    {
        \DB::table('replies')->where('article_id', $article->id)->delete();
    }
}