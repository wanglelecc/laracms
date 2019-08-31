@php
    $block = get_block("2018_03_04_235540_index_hot_news_block");
    $category_id = get_block_params($block->content, 'category_id', 0);
@endphp
@if($block->data)
<dl class="fly-panel fly-list-one">
    <dt class="fly-panel-title">{{$block->title}}</dt>
    @foreach($block->data as $item)
    <dd> <a href="{{$item->getLink(4,$category_id)}}">{{$item->title}}</a> <span><i class="iconfont icon-liulanyanjing"></i> {{$item->views}}</span> </dd>
    @endforeach
</dl>
@endif

<!--
<div class="fly-panel">
    <div class="fly-panel-title"> 心级赞助商 <span style="padding: 0 3px;">-</span> <a href="/jie/15697/" class="fly-link fly-joinad    ">我要加入</a> </div>
    <div class="fly-panel-main">
        <a href="http://core.fineui.com/" target="_blank" rel="nofollow" class="fly-zanzhu" style="background-color: #205B95;" time-limit="2018-07-18 0:0:0">FineUI - 9 年控件库 + ASP.NET Core 2.0</a>
        <a href="http://www.phpyun.com/" target="_blank" rel="nofollow" class="fly-zanzhu" style="background-color: #FF7300" time-limit="2018-04-27 0:0:0">phpyun - 人才招聘系统+商家小程序</a>
    </div>
</div>

<div class="fly-panel">
    <div class="fly-panel-title"> 官方产品 </div>
    <div class="fly-panel-main">
        <a href="http://layim.layui.com/?from=fly" target="_blank" class="fly-zanzhu" time-limit="2017.09.25-2099.01.01" style="background-color: #5FB878;">LayIM 3.0 - layui 旗舰之作</a>
    </div>
</div>

<div class="fly-panel" style="padding: 20px 0; text-align: center;"> <img src="//cdn.layui.com/upload/2017_8/168_1501894831075_19619.jpg" style="max-width: 100%;" alt="layui">
    <p style="position: relative; color: #666;">微信扫码关注 layui 公众号</p>
</div>
-->