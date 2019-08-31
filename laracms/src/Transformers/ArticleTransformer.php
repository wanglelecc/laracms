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

namespace Wanglelecc\Laracms\Transformers;

use Wanglelecc\Laracms\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'object_id' => $article->object_id,
            'title' => $article->title,
            'subtitle' => $article->subtitle,
            'keywords' => $article->keywords,
            'description' => $article->description,
            'author' => $article->author,
            'thumb' => storage_image_url($article->thumb),
            'content' => $article->content,
            'is_link' => $article->is_link,
            'link' => $article->getLink(),
            'created_at' => $article->created_at->toDateTimeString(),
            'updated_at' => $article->updated_at->toDateTimeString(),
        ];
    }

}