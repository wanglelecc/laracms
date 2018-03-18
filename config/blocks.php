<?php
/**
 * Created by PhpStorm.
 * User: lele.wang
 * Date: 2018/2/20
 * Time: 20:35
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
//        'blogTree' => '博客分类',
        'pageList' => '单页列表',
        'contact' => '联系我们',
        'about' => '公司简介',
        'links' => '友情链接',
        'header' => '网站头部',
        'followUs' => '关注我们',
    ],

    // 结构体
    'structure' => [
        // 2018_03_04_224530_index_slide_block
       '1593921820130870' => ['id' => 1, 'object_id' => '1593921820130870', 'group' => 0, 'type' => 'slide', 'template' => 'default', 'title' => '首页幻灯',  'created_op'=>1, 'updated_op'=>1, 'content'=>'{"mark":"1"}',],
       '1593926806514812' => ['id' => 2, 'object_id' => '1593926806514812', 'group' => 0, 'type' => 'hotArticle', 'template' => 'default', 'title' => '企业新闻', 'more_title'=>'更多', 'more_link'=>'/article/list_2_1.html', 'created_op'=>1, 'updated_op'=>1, 'content'=>'{"category_id":"1","display":"4"}',],
       '1593929822441295' => ['id' => 3, 'object_id' => '1593929822441295', 'group' => 0, 'type' => 'hotArticle', 'template' => 'default', 'title' => '成功案例', 'more_title'=>'更多', 'more_link'=>'/article/list_3_2.html', 'created_op'=>1, 'updated_op'=>1, 'content'=>'{"category_id":"2","display":"4"}',],
       '1593930272075407' => ['id' => 4, 'object_id' => '1593930272075407', 'group' => 0, 'type' => 'hotArticle', 'template' => 'default', 'title' => '本周热议', 'created_op'=>1, 'updated_op'=>1, 'content'=>'{"category_id":"3","display":"10"}',],

],

];