<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
            @foreach(config('administrator.menu') as $key => $menu)
                @if(call_user_func($menu['permission']))
                <li class="layui-nav-item layui-nav-itemed">
                    <a class="" href="@if(!empty($menu['link'])) {{$menu['link']}} @elseif(!empty($menu['route'])) {{route($menu['route'], $menu['params'])}} @else javascript:; @endif">{{ $menu['text'] }}</a>
                    <dl class="layui-nav-child">
                        @foreach($menu['children'] as $key => $item)
                            @if(call_user_func($item['permission']))
                            <dd><a href="@if(!empty($item['link'])){{$item['link']}}@elseif(!empty($item['route'])){{route($item['route'], $item['params'])}}@else javascript:;@endif">{{ $item['text'] }}</a></dd>
                            @endif
                        @endforeach
                    </dl>
                </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
