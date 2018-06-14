<div class="layui-header header">
    <div class="layui-logo">{{ config('app.name', 'LaraCMS')  }}</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
        @foreach(config('administrator.shortcut') as $key => $menu)
            @if(call_user_func($menu['permission']))
            <li class="layui-nav-item"><a href="@if(!empty($menu['link'])) {{$menu['link']}} @elseif(!empty($menu['route'])) {{route($menu['route'], $menu['params'])}} @else javascript:; @endif">{{ $menu['text'] }}</a>
                @if($menu['children'])
                <dl class="layui-nav-child">
                    @foreach($menu['children'] as $key => $item)
                        @if(call_user_func($item['permission']))
                            <dd><a href="@if(!empty($item['link'])){{$item['link']}}@elseif(!empty($item['route'])){{route($item['route'], $item['params'])}}@else javascript:;@endif">{{ $item['text'] }}</a></dd>
                        @endif
                    @endforeach
                </dl>
                @endif
            </li>
            @endif
        @endforeach
    </ul>
    <ul class="layui-nav layui-layout-right">

        @guest
        <li class="layui-nav-item"><a href="{{ route('administrator.login') }}">登录</a></li>
        @else
        <li class="layui-nav-item">
            <a href="javascript:;">
                <img src="{{ Auth::user()->getAvatar() }}" class="layui-nav-img" />
                {{ Auth::user()->name }}
            </a>
            <dl class="layui-nav-child layui-nav-header">
                <dd><a href="{{ route('user.edit', Auth::user()->id)  }}">基本资料</a></dd>
                <dd><a href="{{ route('administrator.password.edit', Auth::user()->id )  }}">修改密码</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item">
            <a href="{{ route('administrator.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">退出</a>
            <form id="logout-form" action="{{ route('administrator.logout') }}" method="GET" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        @endguest
    </ul>
</div>
