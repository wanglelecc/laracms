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

use Wanglelecc\Laracms\Models\Page;
use League\Fractal\TransformerAbstract;

class PageTransformer extends TransformerAbstract
{
    public function transform(Page $page)
    {
        return [
            'id' => $page->id,
            'object_id' => $page->object_id,
            'title' => $page->title,
            'subtitle' => $page->subtitle,
            'keywords' => $page->keywords,
            'description' => $page->description,
            'author' => $page->author,
//            'thumb' => storage_image_url($page->thumb),
            'content' => $page->content,
            'is_link' => $page->is_link,
            'link' => $page->getLink(),
            'created_at' => $page->created_at->toDateTimeString(),
            'updated_at' => $page->updated_at->toDateTimeString(),
        ];
    }

}