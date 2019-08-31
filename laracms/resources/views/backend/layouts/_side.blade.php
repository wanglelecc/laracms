@php
    $activeNavId = app('active')->getController()::$activeNavId;
@endphp

<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="@if($activeNavId == 'dashboard') active @endif">
                <a href="{{route('administrator.dashboard')}}">
                    <i class="icon icon-dashboard"></i>
                    <span>仪表盘</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            @foreach(config('administrator.menu') as $key1 => $menu)
                @if(call_user_func($menu['permission']))
                <li class="treeview @if($activeNavId == $menu['id']) active @endif">
                    <a href="@if(!empty($menu['link'])) {{$menu['link']}} @elseif(!empty($menu['route'])) {{route($menu['route'], $menu['params'])}}@if(!empty($menu['query']))?{{implode('&',$menu['query'])}}@endif @else javascript:; @endif">
                        <i class="icon {{ empty($menu['icon']) ? 'icon-circle-blank' : $menu['icon'] }}"></i>
                        <span>{{ $menu['text'] }}</span>
                        <span class="pull-right-container">
                            <i class="icon icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @foreach($menu['children'] as $key2 => $item)
                            @if(call_user_func($item['permission']))
                                <li id="nav_{{$key1}}_{{$key2}}" class="@if($activeNavId == $item['id']) active @endif">
                                    <a href="@if(!empty($item['link'])){{$item['link']}}@elseif(!empty($item['route'])){{route($item['route'], $item['params'])}}@if(!empty($item['query']))?{{implode('&',$item['query'])}}@endif @else javascript:;@endif">
                                        <i class="icon {{ empty($item['icon']) ? 'icon-circle-blank' : $item['icon'] }}"></i> {{ $item['text'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endif
            @endforeach

            <!--
            <li class="treeview">
                <a href="javascript:;">
                    <i class="icon icon-file"></i>
                    <span>页面演示</span>
                    <span class="pull-right-container">
                        <i class="icon icon-angle-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href=""><i class="icon icon-circle-blank"></i> 空白页</a></li>
                    <li><a href=""><i class="icon icon-circle-blank"></i> 登录</a></li>
                    <li><a href=""><i class="icon icon-circle-blank"></i> 404页</a></li>
                    <li><a href=""><i class="icon icon-circle-blank"></i> 系统设置</a></li>
                    <li><a href=""><i class="icon icon-circle-blank"></i> 用户列表</a></li>
                </ul>
            </li>
            -->
        </ul>
    </section>
</aside>
