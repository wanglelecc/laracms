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

namespace Wanglelecc\Laracms\Observers;

use Wanglelecc\Laracms\Models\Reply;
use Wanglelecc\Laracms\Notifications\ArticleReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 回复观察者
 *
 * Class ReplyObserver
 * @package Wanglelecc\Laracms\Observers
 */
class ReplyObserver
{
    public function created(Reply $reply)
    {
        $article = $reply->article;
        $article->increment('reply_count', 1);

        // 如果评论的作者不是话题的作者，才需要通知
        if ( ! $reply->user->isAuthorOf($article)) {
            $article->user->notify(new ArticleReplied($reply));
        }
    }

    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_article_body');
    }

    public function deleted(Reply $reply)
    {
        $reply->article->decrement('reply_count', 1);
    }
}