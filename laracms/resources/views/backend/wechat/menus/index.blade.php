@extends('backend::layouts.app')

@section('title', $title = $wechat->name.'菜单')

@section('navigation')
    <a class="btn btn-normal btn-sm" href="{{ route('wechats.index') }}">微信管理</a>
@endsection

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li><a href="javascript:;">微信管理</a></li>
    <li><a href="javascript:;">微信菜单</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">

            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                </div>
                <div class="tools-group">
                    <a href="{{ route('wechat.menus.create', [$wechat->id, 0]) }}"  class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                    <button class="btn btn-danger" form="form-list"><i class="icon icon-sort-by-order-alt"></i> 排序</button>
                    <button type="submit" class="btn btn-info form-sync" _form="form-sync"><i class="icon icon-spin icon-refresh"></i> 同步到微信服务器</button>
                </div>
            </div>

            @if($wechat_menus->count())
                <form name="form-sync" id="form-sync" method="POST" action="{{route('wechat.menus.sync', $wechat->id)}}">
                    <input type="hidden" name="_method" value="POST">
                    {{ csrf_field() }}
                </form>
                <form name="form-list" id="form-list" class="layui-form layui-form-pane" method="POST" action="{{route('wechat.menus.order',$wechat->id)}}">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <table class="table table-bordered">
                        <colgroup>
                            <col width="50">
                            <col width="70">
                            <col width="330">
                            <col width="100">
                            <col>
                            <col width="200">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">排序</th>
                            <th class="text-center">名称</th>
                            <th class="text-center">类型</th>
                            <th class="text-center">值</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wechat_menus as $index => $wechat_menu)
                            <tr>
                                <td class="text-center">{{ $wechat_menu->id }}</td>
                                <td class="text-center">
                                    <input type="hidden" name="id[]" value="{{$wechat_menu->id}}">
                                    <input type="tel" name="order[]" autocomplete="off" class="form-control text-center" value="{{ $wechat_menu->order  }}">
                                </td>
                                <td>{{ str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$wechat_menu->lavel)}}@if($wechat_menu->lavel > 0)├─ @endif{{$wechat_menu->name}}</td>
                                <td class="text-center">@switch($wechat_menu->type)
                                        @case('text') 回复文本 @break
                                        @case('event') 自定义事件 @break
                                        @case('content') 响应内容 @break
                                        @case('view') 跳转URL @break
                                        @case('media_id') 下发消息 @break
                                        @case('view_limited') 跳转图文 @break
                                    @endswitch</td>
                                <td class="text-center">@switch($wechat_menu->type)
                                        @case('view') {{get_json_params($wechat_menu->data,'link')}} @break
                                        @case('text') {{get_json_params($wechat_menu->data,'text')}} @break
                                        @case('event') {{get_json_params($wechat_menu->data,'event')}} @break
                                        @case('content') 文章：{{get_json_params($wechat_menu->data,'category_name')}} @break
                                        @case('media_id') {{get_json_params($wechat_menu->data,'media_id')}} @break
                                        @case('view_limited') {{get_json_params($wechat_menu->data,'media_id')}} @break
                                    @endswitch</td>
                                <td class="text-center">
                                    <a href="{{ route('wechat.menus.edit', [$wechat_menu->id, $wechat_menu->group]) }}" class="btn btn-xs btn-primary">编辑</a>
                                    <a href="javascript:;" data-url="{{ route('wechat.menus.destroy', [$wechat_menu->id, $wechat_menu->group]) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                                    @if($wechat_menu->parent == 0)<a href="{{ route('wechat.menus.create', [$wechat->id, $wechat_menu->id]) }}" class="btn btn-xs btn-success">添加</a>@endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>

            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(".form-sync").click(function(){

            bootbox.confirm({
                size: "small",
                title: "系统提示",
                message: "确认同步吗？",
                callback: function(result){ if(result === true){ $("#form-sync").submit(); } }
            });

            return false;
        });
    </script>
@endsection