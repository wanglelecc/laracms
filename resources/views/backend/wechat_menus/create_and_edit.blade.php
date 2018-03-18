@extends('backend.layouts.app')

@section('title', $title = $wechat_menu->id ? '编辑菜单' : '添加菜单' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">微信管理</a>
    <a href="">微信菜单</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
@php
    $type = $wechat_menu->type ?? request('type', '');
@endphp
<div class="layui-main">

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
    </fieldset>

    <form class="layui-form layui-form-pane" method="POST" action="{{ $wechat_menu->id ? route('wechat_menus.update', [$wechat_menu->id, $wechat->id]) : route('wechat_menus.store', $wechat->id) }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="{{ $wechat_menu->id ? 'PUT' : 'POST' }}">

            @if( ! $wechat_menu->id)
            <input type="hidden" name="group" value="{{ old('group',$wechat->id) }}" >
            @else
            <input type="hidden" name="group" value="{{ old('group',$wechat_menu->group) }}">
            @endif

            @if( ! $wechat_menu->parent)
                <input type="hidden" name="parent" value="{{ old('parent',$parent) }}" >
            @else
                <input type="hidden" name="parent" value="{{ old('parent',$wechat_menu->parent) }}">
            @endif

            <div class="layui-form-item">
                <label class="layui-form-label">菜单类型</label>
                <div class="layui-input-block">
                    @if($wechat_menu->id)
                        <input type="hidden" name="type" value="{{$type}}" />
                        <input type="text"  class="layui-input" disabled value="@switch($type)
                        @case('text') 回复文本 @break
                        @case('event') 自定义事件 @break
                        @case('content') 响应内容 @break
                        @case('view') 跳转URL @break
                        @case('media_id') 下发消息 @break
                        @case('view_limited') 跳转图文 @break
                        @endswitch">
                    @else
                        <select name="type" lay-filter="wechat_menu_type">
                            <option value=""></option>
                            <option @if($type == 'text') selected @endif value="text">回复文本</option>
                            <option @if($type == 'event') selected @endif value="event">自定义事件</option>
                            <option @if($type == 'content') selected @endif value="content">响应内容</option>
                            <option @if($type == 'view') selected @endif value="view">跳转URL</option>
                            <option @if($type == 'media_id') selected @endif value="media_id">下发消息</option>
                            <option @if($type == 'view_limited') selected @endif value="view_limited">跳转图文</option>
                        </select>
                    @endif
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" for="name-field">菜单名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" id="name-field" lay-verify="required" autocomplete="off" placeholder="请输入名称" class="layui-input" value="{{ old('name',$wechat_menu->name) }}" >
                </div>
            </div>

            @if($type)
                @include('backend.wechat_menus.template.'.$type,['wechat_menu' => $wechat_menu])
            @endif

            {{--<div class="layui-form-item">--}}
                {{--<label class="layui-form-label" for="order-field">排序</label>--}}
                {{--<div class="layui-input-block">--}}
                    {{--<input type="text" name="order" id="order-field" lay-verify="required" autocomplete="off" placeholder="排序" class="layui-input" value="{{ old('order',$wechat_menu->order) }}" >--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
    </form>

</div>

@endsection

@section('scripts')
    <script type="text/javascript">
        layui.form.on('select(wechat_menu_type)', function(data){
            var nUrl = window.jsUrlHelper.putUrlParam( window.location.href.toString(), 'type', data.value);
            window.location.href = nUrl;
        });

        layui.form.on('select(wechat_menu_content_category_id)', function(data){
            $("#wechat_menu_content_category_name").val($(data.elem).find("option:selected").text());
        });
    </script>
@endsection