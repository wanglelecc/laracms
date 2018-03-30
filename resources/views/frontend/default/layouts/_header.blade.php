@php

$navigations = frontend_navigation('desktop');
//$currentBrothersAndChildNavigation = frontend_current_brother_and_child_navigation('desktop');

$currentChildNavigations = frontend_current_child_navigation('desktop');
@endphp

<div class="fly-header layui-bg-black">
    <div class="layui-container">
        <a class="fly-logo" href="/"><img src="{{asset('images/logo.png')}}" alt="layui"></a>

        <ul class="layui-nav fly-nav layui-hide-xs">
            <li class="layui-nav-item"><a href="/">首页</a></li>

            @foreach($navigations as $navigation)
            <li class="layui-nav-item">
                <a target="{{ $navigation->target }}" href="{{$navigation->link}}">{{ $navigation->title }}</a>
                @if($navigation->child)
                <dl class="layui-nav-child">
                    @foreach($navigation->child as $nav)
                    <dd><a target="{{ $navigation->target }}" href="{{$nav->link}}">{{ $nav->title }}</a></dd>
                    @endforeach
                </dl>
                @endif
            </li>
            @endforeach
        </ul>

        <ul class="layui-nav fly-nav-user">
            <li class="layui-nav-item"><a href="" _href="{{route('login')}}">登录</a></li>
            <li class="layui-nav-item"><a href="">退出</a></li>
        </ul>
    </div>
</div>



<div class="fly-panel fly-column">
    <div class="layui-container">
        @include('frontend.default.layouts._breadcrumb')
        <ul class="layui-clear">
            <!--
            <li class="layui-hide-xs  layui-this"><a href="/">首页</a></li>
            <li> <a href=""> 提问 </a> </li>
            <li> <a href=""> 分享 <span class="layui-badge-dot"></span> </a> </li>
            -->
            @if(($current_nav_id = request('navigation', 0)) > 0) @foreach($currentChildNavigations as $navigation)
            <li class="@if($current_nav_id == $navigation->id) layui-hide-xs  layui-this @endif"><a target="{{ $navigation->target }}" href="{{$navigation->link}}">{{ $navigation->title }}</a> </li>
            @endforeach @endif
        </ul>
        <div class="fly-column-right layui-hide-xs">
            <span class="fly-search LAY_search"><i class="layui-icon"></i></span>
        </div>
        {{--<div class="layui-hide-sm layui-show-xs-block" style="margin-top: -10px; padding-bottom: 10px; text-align: center;">--}}
            {{--<a href="" class="layui-btn">发表新帖</a>--}}
        {{--</div>--}}
    </div>
</div>