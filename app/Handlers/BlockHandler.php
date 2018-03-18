<?php
/**
 * Created by PhpStorm.
 * User: lele.wang
 * Date: 2018/1/31
 * Time: 23:03
 */

namespace App\Handlers;
use App\Models\Article;
use App\Models\Category;
use App\Models\Block;
use App\Models\Link;
use App\Models\Page;
use App\Models\Slide;
use App\Handlers\CategoryHandler;

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

    protected function html(Block $block){
        return $block->content;
    }

    protected function htmlcode(Block $block){
        return $block->content;
    }

    protected function phpcode(Block $block){
        return $block->content;
    }

    protected function latestArticle(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        $category_id = get_value($content, 'category_id', 0);

        return Category::find($category_id)->articles()->recent()->offset(0)->limit(get_value($content, 'display', 10))->get();
    }

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

    protected function slide(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        $mark = get_value($content, 'mark', 0);
        return app(Slide::class)->where('group',$mark)->ordered()->recent()->get();
    }

    protected function articleTree(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        $type = get_value($content, 'type', '');

        $categoryHandler = app(CategoryHandler::class);
        return $categoryHandler->withRecursion($categoryHandler->getCategorys($type));
    }

    protected function blogTree(Block $block){
        return $this->articleTree($block);
    }

    protected function pageList(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        return app(Page::class)->ordered()->recent()->offset(0)->limit(get_value($content, 'display', 10))->get();
    }

    protected function contact(Block $block){
        return config("system.common.contact");
    }

    protected function about(Block $block){
        return config("system.common.company.content");
    }

    protected function links(Block $block){
        $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
        return app(Link::class)->ordered()->recent()->offset(0)->limit(get_value($content, 'display', 10))->get();
    }

    protected function header(Block $block){
        return $block->content;
    }

    protected function followUs(Block $block){
        return config("system.common.contact");
    }

}