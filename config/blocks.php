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

return [
    'types' => [
        'html' => '自定义',
        'htmlcode' => 'HTML源代码',
        'phpcode' => 'PHP源代码',
        'latestArticle' => '最新文章',
        'hotArticle' => '热门文章',
//        'latestProduct' => '最新产品',
//        'hotProduct' => '热门产品',
        'slide' => '幻灯片',
        'articleTree' => '文章分类',
        'navigation' => '栏目导航', // 需要添加默认参数 category 可选值：desktop, footer, mobile
//        'blogTree' => '博客分类',
        'pageList' => '单页列表',
        'contact' => '联系我们',
        'about' => '公司简介',
        'links' => '友情链接',
        'header' => '网站头部',
        'followUs' => '关注我们',
        'recommend' => '推荐位',
    ],

    // 结构体
    'structure' => [
       '2018_03_04_224524_index_slide_block'                => ['id' => 1, 'object_id' => '2018_03_04_224524_index_slide_block',                    'group' => 0, 'type' => 'slide', 'template' => 'default', 'title' => '首页幻灯',  'created_op'=>1, 'updated_op'=>1, 'content'=>'{"mark":"1"}',],
       '2018_03_04_234810_index_enterprise_news_block'      => ['id' => 2, 'object_id' => '2018_03_04_234810_index_enterprise_news_block',          'group' => 0, 'type' => 'hotArticle', 'template' => 'default', 'title' => '企业新闻', 'more_title'=>'更多', 'more_link'=>'/article/list_2_1.html', 'created_op'=>1, 'updated_op'=>1, 'content'=>'{"category_id":"1","display":"4"}',],
       '2018_03_04_235036_index_case_news_block'            => ['id' => 3, 'object_id' => '2018_03_04_235036_index_case_news_block',                'group' => 0, 'type' => 'hotArticle', 'template' => 'default', 'title' => '成功案例', 'more_title'=>'更多', 'more_link'=>'/article/list_3_2.html', 'created_op'=>1, 'updated_op'=>1, 'content'=>'{"category_id":"2","display":"4"}',],
       '2018_03_04_235540_index_hot_news_block'             => ['id' => 4, 'object_id' => '2018_03_04_235540_index_hot_news_block',                 'group' => 0, 'type' => 'hotArticle', 'template' => 'default', 'title' => '本周热议', 'created_op'=>1, 'updated_op'=>1, 'content'=>'{"category_id":"3","display":"10"}',],
       '2018_03_04_235951_index_recommend_news_block'       => ['id' => 5, 'object_id' => '2018_03_04_235951_index_recommend_news_block',           'group' => 0, 'type' => 'recommend', 'template' => 'default', 'title' => '首页推荐位', 'created_op'=>1, 'updated_op'=>1, 'content'=>'{}',],
    ],

];