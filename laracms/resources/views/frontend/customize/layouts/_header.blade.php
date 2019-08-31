@php

$navigations = frontend_navigation('desktop');
//$currentBrothersAndChildNavigation = frontend_current_brother_and_child_navigation('desktop');

$currentChildNavigations = frontend_current_child_navigation('desktop');
@endphp

<div class="fly-header layui-bg-black">
    <div class="layui-container">
        <a class="fly-logo" href="/"><img src="{{asset('vendor/laracms/images/logo.png')}}" alt="layui"></a>

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
            @guest
            <li class="layui-nav-item"><a href="{{route('login')}}">登录</a></li>
            <li class="layui-nav-item"><a href="{{route('register')}}">注册</a></li>
            <li class="layui-nav-item layui-hide-xs">
                <a href="{{route('oauth.login','qq')}}" onclick="layer.msg('正在通过QQ登录', {icon:16, shade: 0.1, time:0})" title="QQ登录" class="iconfont icon-qq"></a>
            </li>
            <li class="layui-nav-item layui-hide-xs">
                <a href="{{route('oauth.login','weibo')}}" onclick="layer.msg('正在通过微博登录', {icon:16, shade: 0.1, time:0})" title="微博登录" class="iconfont icon-weibo"></a>
            </li>
            <li class="layui-nav-item layui-hide-xs">
                <a href="{{route('oauth.login','github')}}" onclick="layer.msg('正在通过Github登录', {icon:16, shade: 0.1, time:0})" title="Github登录" class="iconfont icon-github"></a>
            </li>
            @else
            <li class="layui-nav-item" style="margin-right: 15px;">
                <a href="{{ route('user.messages') }}" style="margin-top: -2px;">
                    <i class="layui-badge fly-badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'fade' }} " title="消息提醒">{{ Auth::user()->notification_count }}</i>
                </a>
            </li>
            <li class="layui-nav-item">
                <a class="fly-nav-avatar" href="javascript:;">
                    <cite class="layui-hide-xs">{{ Auth::user()->name }}</cite>
                    <img src="{{ Auth::user()->getAvatar() }}">
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="{{route('user.settings')}}"><i class="layui-icon">&#xe620;</i>基本设置</a></dd>
                    <dd><a href="{{route('user.messages')}}"><i class="iconfont icon-tongzhi" style="top: 4px;"></i>我的消息</a></dd>
                    <dd><a href="{{route('user.home', Auth::user()->id )}}"><i class="layui-icon" style="margin-left: 2px; font-size: 22px;">&#xe68e;</i>我的主页</a></dd>
                    <hr style="margin:5px 0;">
                    <dd><a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="text-align: center;">退出</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </dd>
                </dl>
            </li>
            @endguest
        </ul>

    </div>
</div>


@if($breadcrumb ?? true)
<div class="fly-panel fly-column">
    <div class="layui-container">
        @include('frontend::layouts._breadcrumb')
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
@endif