<?php

namespace Wanglelecc\Laracms\Observers;

use Wanglelecc\Laracms\Models\Project;
use Wanglelecc\Laracms\Handlers\SlugTranslateHandler;
use Wanglelecc\Laracms\Jobs\TranslateSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ProjectObserver
{
    public function creating(Project $project)
    {
        //
    }

    public function updating(Project $project)
    {
        //
    }

    public function saving(Project $project)
    {
//        // XSS 过滤
//        $project->body = clean($project->body, 'user_body');
//
//        // 生成话题摘录
//        $topic->excerpt = make_excerpt($topic->body);
//
//        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
//        if ( ! $topic->slug) {
//            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
//        }
    }

//    public function saved(Topic $topic)
//    {
//        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
//        if ( ! $topic->slug) {
//
//            // 推送任务到队列
//            dispatch(new TranslateSlug($topic));
//        }
//    }
}