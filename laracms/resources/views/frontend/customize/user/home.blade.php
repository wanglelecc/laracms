@extends('frontend::layouts.app')

@section('title', $title = '我的主页')

@php
    $breadcrumb = false;
@endphp

@section('breadcrumb')
    <a><cite>{{$title}}</cite></a>
@endsection

@section('content')
    <div class="fly-home fly-panel" style="background-image: url();">
        <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}">
        <i class="iconfont icon-renzheng" title="已认证"></i>
        <h1>
            {{ $user->name }}
            {{--<i class="iconfont icon-nan"></i>--}}
            <!-- <i class="iconfont icon-nv"></i>  -->
            {{--<i class="layui-badge fly-badge-vip">VIP3</i>--}}
            <!--
            <span style="color:#c00;">（管理员）</span>
            <span style="color:#5FB878;">（社区之光）</span>
            <span>（该号已被封）</span>
            -->
        </h1>

        {{--<p style="padding: 10px 0; color: #5FB878;">认证信息：layui 作者</p>--}}

        <p class="fly-home-info">
            {{--<i class="iconfont icon-kiss" title="飞吻"></i><span style="color: #FF7200;">66666 飞吻</span>--}}
            <i class="iconfont icon-shijian"></i><span>{{ $user->created_at->diffForHumans() }} 加入</span>
            <i class="iconfont icon-chengshi"></i><span>来自 {{ $user->last_location }}</span>
        </p>

        <p class="fly-home-sign">{{ $user->introduction }}</p>

        <!--
        <div class="fly-sns" data-user="">
            <a href="javascript:;" class="layui-btn layui-btn-primary fly-imActive" data-type="addFriend">加为好友</a>
            <a href="javascript:;" class="layui-btn layui-btn-normal fly-imActive" data-type="chat">发起会话</a>
        </div>
        -->

    </div>

    <div class="layui-container">
        <div class="layui-row layui-col-space15">
            {{--<div class="layui-col-md6 fly-home-jie">--}}
                {{--<div class="fly-panel">--}}
                    {{--<h3 class="fly-panel-title">贤心 最近的提问</h3>--}}
                    {{--<ul class="jie-row">--}}
                        {{--<li>--}}
                            {{--<span class="fly-jing">精</span>--}}
                            {{--<a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>--}}
                            {{--<i>刚刚</i>--}}
                            {{--<em class="layui-hide-xs">1136阅/27答</em>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>--}}
                            {{--<i>1天前</i>--}}
                            {{--<em class="layui-hide-xs">1136阅/27答</em>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>--}}
                            {{--<i>2017-10-30</i>--}}
                            {{--<em class="layui-hide-xs">1136阅/27答</em>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>--}}
                            {{--<i>1天前</i>--}}
                            {{--<em class="layui-hide-xs">1136阅/27答</em>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>--}}
                            {{--<i>1天前</i>--}}
                            {{--<em class="layui-hide-xs">1136阅/27答</em>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>--}}
                            {{--<i>1天前</i>--}}
                            {{--<em class="layui-hide-xs">1136阅/27答</em>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>--}}
                            {{--<i>1天前</i>--}}
                            {{--<em class="layui-hide-xs">1136阅/27答</em>--}}
                        {{--</li>--}}
                        {{--<!-- <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i style="font-size:14px;">没有发表任何求解</i></div> -->--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="layui-col-md12 fly-home-da">
                <div class="fly-panel">
                    <h3 class="fly-panel-title">{{ $user->name }} 最近的回复</h3>
                    @php
                        $replies = $user->replies()->with('article')->recent()->paginate(5);
                    @endphp
                    <ul class="home-jieda">
                        @if (count($replies))
                            @foreach ($replies as $reply)
                            <li>
                                <p><span>{{ $reply->created_at->diffForHumans() }}</span>在<a href="" target="_blank">{{ $reply->article->title }}</a>中回复：</p>
                                <div class="home-dacontent">
                                    {!! $reply->content !!}
                                </div>
                            </li>
                            @endforeach
                        @else
                            <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><span>没有任何回复</span></div>
                        @endif
                    </ul>

                    {{--<div id="pagination"></div>--}}
                    <div style="text-align: center">
                        {{ $replies->links('pagination::frontend') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

