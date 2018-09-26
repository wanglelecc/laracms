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

namespace App\Handlers;
use App\Models\Article;
use App\Models\Category;
use App\Models\Block;
use App\Models\Link;
use App\Models\Page;
use App\Models\Slide;
use App\Handlers\CategoryHandler;

/**
 * 区块工具类
 *
 * Class BlockHandler
 * @package App\Handlers
 */
class BlockHandler
{

    /**
     * 获取区块数据
     *
     * @param $block_id
     * @return null
     */
    public function getBlockData($block_id){
        if($block = $this->getBlock($block_id)){
            $block->data = $this->withBlockContent($block);
            return $block;
        }

        return null;
    }

    /**
     * 查询区块内容
     *
     * @param $objectId
     * @return mixed
     */
    public function getBlock($objectId){
        return Block::where('object_id',$objectId)->first();
    }

    /**
     * 处理区块内容
     *
     * @param Block $block
     * @return null
     */
    public function withBlockContent(Block $block){
        $content = null;

        $action = strtolower($block->type);
        if(method_exists($this,$action)){
            $content = $this->$action($block);
        }

        return $content;
    }

    /**
     * html 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function html(Block $block){
        return $block->content;
    }

    /**
     * htmlcode 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function htmlcode(Block $block){
        return $block->content;
    }

    /**
     * phpcode 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function phpcode(Block $block){
        return $block->content;
    }

    /**
     * recommend(推荐位) 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function recommend(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        $article_ids = get_value($content, 'article_id', []);

        $articles = Article::whereIn('id', $article_ids)->get();

        // 将查询结果按照区块数据顺序排位
        $collection = $articles->getCollection();
        $collection = $collection->sortBy(function ($product, $key) use ($article_ids) {
            return array_search($product->id, $article_ids);
        });
        $articles->setCollection($collection);

        return $articles;
    }

    /**
     * latestArticle(最新文章) 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function latestArticle(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        $category_id = get_value($content, 'category_id', 0);

        return Category::find($category_id)->articles()->recent()->offset(0)->limit(get_value($content, 'display', 10))->get();
    }

    /**
     * hotArticle(最热文章) 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function hotArticle(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        $category_id = get_value($content, 'category_id', 0);

        return Category::find($category_id)->articles()->orderBy("views", "desc")->recent()->offset(0)->limit(get_value($content, 'display', 10))->get();
    }


    protected function latestProduct(Block $block){
        return $block->content;
    }

    protected function hotProduct(Block $block){
        return $block->content;
    }

    /**
     * slide(幻灯) 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function slide(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        $mark = get_value($content, 'mark', 0);
        return app(Slide::class)->where('group',$mark)->active()->ordered()->recent()->get();
    }

    /**
     * articleTree(文章分类) 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function articleTree(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        $type = get_value($content, 'type', '');

        $categoryHandler = app(CategoryHandler::class);
        return $categoryHandler->withRecursion($categoryHandler->getCategorys($type));
    }

    protected function blogTree(Block $block){
        return $this->articleTree($block);
    }

    /**
     * pageList(页面列表) 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function pageList(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        return app(Page::class)->ordered()->recent()->offset(0)->limit(get_value($content, 'display', 10))->get();
    }

    /**
     * contact(联系我们) 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function contact(Block $block){
        return config("system.common.contact");
    }

    /**
     * about(关于我们) 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function about(Block $block){
        return config("system.common.company.content");
    }

    /**
     * links(友情链接) 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function links(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        return app(Link::class)->ordered()->recent()->offset(0)->limit(get_value($content, 'display', 10))->get();
    }

    /**
     * header 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function header(Block $block){
        return $block->content;
    }

    /**
     * followUs(联系方式) 类型区块内容处理
     *
     * @param Block $block
     * @return mixed
     */
    protected function followUs(Block $block){
        return config("system.common.contact");
    }

}