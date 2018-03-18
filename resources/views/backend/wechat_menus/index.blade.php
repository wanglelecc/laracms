@extends('backend.layouts.app')

@section('title', $title = $wechat->name.'菜单')

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">微信管理</a>
    <a href="">微信菜单</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')

<div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <a href="{{ route('wechat_menus.create', [$wechat->id, 0]) }}" class="layui-btn">添加</a>
        <button class="layui-btn layui-btn-danger" form="form-list">排序</button>
        <button type="submit" class="layui-btn layui-btn-normal form-sync" _form="form-sync">同步到微信服务器</button>

        <div class="layui-form">
            <form name="form-sync" id="form-sync" method="POST" action="{{route('wechat_menus.sync', $wechat->id)}}">
                <input type="hidden" name="_method" value="POST">
                {{ csrf_field() }}
            </form>

        @if($wechat_menus->count())
            <form name="form-list" id="form-list" class="layui-form layui-form-pane" method="POST" action="{{route('wechat_menus.order',$wechat->id)}}">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="90">
                        <col> <col> <col>
                        <col width="300">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>排序</th>
                        <th>名称</th>
                        <th>类型</th>
                        <th>值</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wechat_menus as $index => $wechat_menu)
                        <tr>
                            <td>{{ $wechat_menu->id }}</td>
                            <td>
                                <input type="hidden" name="id[]" value="{{$wechat_menu->id}}">
                                <input type="tel" name="order[]" lay-verify="required" autocomplete="off" class="layui-input" value="{{ $wechat_menu->order  }}">
                            </td>
                            <td>{{ str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$wechat_menu->lavel)}}@if($wechat_menu->lavel > 0)├─ @endif{{$wechat_menu->name}}</td>
                            <td>@switch($wechat_menu->type)
                                    @case('text') 回复文本 @break
                                    @case('event') 自定义事件 @break
                                    @case('content') 响应内容 @break
                                    @case('view') 跳转URL @break
                                    @case('media_id') 下发消息 @break
                                    @case('view_limited') 跳转图文 @break
                                @endswitch</td>
                            <td>@switch($wechat_menu->type)
                                    @case('view') {{get_json_params($wechat_menu->data,'link')}} @break
                                    @case('text') {{get_json_params($wechat_menu->data,'text')}} @break
                                    @case('event') {{get_json_params($wechat_menu->data,'event')}} @break
                                    @case('content') 文章：{{get_json_params($wechat_menu->data,'category_name')}} @break
                                    @case('media_id') {{get_json_params($wechat_menu->data,'media_id')}} @break
                                    @case('view_limited') {{get_json_params($wechat_menu->data,'media_id')}} @break
                                @endswitch</td>
                            <td>
                                <a href="{{ route('wechat_menus.edit', [$wechat_menu->id, $wechat_menu->group]) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                                <a href="javascript:;" data-url="{{ route('wechat_menus.destroy', [$wechat_menu->id, $wechat_menu->group]) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
                                @if($wechat_menu->parent == 0)<a href="{{ route('wechat_menus.create', [$wechat->id, $wechat_menu->id]) }}" class="layui-btn layui-btn-sm">添加</a>@endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </form>
                <form id="delete-form" action="" method="POST" style="display:none;">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                </form>
                <div id="paginate-render" style="display: none;"></div>
            @else
                <br />
                <blockquote class="layui-elem-quote">暂无数据!</blockquote>
            @endif

        </div>
    </div>
@endsection


@section('scripts')
    @include('backend.layouts._paginate',[ 'count' => 0, ])
    <script type="text/javascript">
        $(".form-sync").click(function(){
            layer.confirm('确认同步吗？', {
                btn: ['确认', '取消']
            }, function(index){
                $("#form-sync").submit();
                layer.close(index);
                return false;
            }, function(index){
                layer.close(index);
                return true;
            });
            return false;
        });
    </script>
@endsection