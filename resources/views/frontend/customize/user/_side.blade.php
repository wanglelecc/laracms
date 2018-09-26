<ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
    <li class="layui-nav-item @if($side == 'home') layui-this @endif"><a href="{{route('user.home', Auth::user()->id )}}"><i class="layui-icon">&#xe609;</i>我的主页</a></li>
    <li class="layui-nav-item @if($side == 'index') layui-this @endif"><a href="{{route('user.index')}}"><i class="layui-icon">&#xe612;</i>用户中心</a></li>
    <li class="layui-nav-item @if($side == 'settings') layui-this @endif"><a href="{{route('user.settings')}}"><i class="layui-icon">&#xe620;</i>基本设置</a></li>
    <li class="layui-nav-item @if($side == 'messages') layui-this @endif"><a href="{{route('user.messages')}}"><i class="layui-icon">&#xe611;</i>我的消息</a></li>
</ul>

<div class="site-tree-mobile layui-hide"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>
<div class="site-tree-mobile layui-hide"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>