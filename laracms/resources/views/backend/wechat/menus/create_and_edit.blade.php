@extends('backend::layouts.app')

@section('title', $title = $wechat_menu->id ? '编辑菜单' : '添加菜单' )

@section('navigation')
    <a class="layui-btn layui-btn-normal layui-btn-sm" href="{{ route('wechats.index') }}">微信管理</a>
@endsection

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li><a href="javascript:;">微信管理</a></li>
    <li><a href="javascript:;">微信菜单</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
@php
    $type = $wechat_menu->type ?? request('type', '');
@endphp

<h2 class="header-dividing">{{$title}} <small></small></h2>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">

                <form id="form-validator" class="form-horizontal" method="POST" action="{{ $wechat_menu->id ? route('wechat.menus.update', [$wechat_menu->id, $wechat->id]) : route('wechat.menus.store', $wechat->id) }}">
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

                    <div class="form-group has-feedback  has-icon-right">
                        <label for="app_id" class="col-md-2 col-sm-2 control-label required">类型</label>
                        <div class="col-md-5 col-sm-10">
                        @if($wechat_menu->id)
                            <input type="hidden" name="type" value="{{$type}}" />
                            <input type="text"  class="form-control" disabled value="@switch($type)
                            @case('text') 回复文本 @break
                            @case('event') 自定义事件 @break
                            @case('content') 响应内容 @break
                            @case('view') 跳转URL @break
                            @case('media_id') 下发消息 @break
                            @case('view_limited') 跳转图文 @break
                            @endswitch">
                        @else
                            <select name="type" class="form-control" id="wechat_menu_type">
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

                    <div class="form-group has-feedback  has-icon-right">
                        <label for="name" class="col-md-2 col-sm-2 control-label required">菜单名称</label>
                        <div class="col-md-5 col-sm-10">
                        <input type="text" name="name" id="name" autocomplete="off" placeholder="" class="form-control" value="{{ old('name',$wechat_menu->name) }}"
                               required
                               data-fv-trigger="blur"
                               minlength="1"
                               maxlength="128"
                        ></div>
                    </div>

                    @if($type)
                        @include('backend::wechat.menus.template.'.$type,['wechat_menu' => $wechat_menu])
                    @endif

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-5 col-sm-10">
                            <button type="submit" class="btn btn-primary">提交</button>
                            <button type="reset" class="btn btn-default">重置</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">

        $('#wechat_menu_type').bind('change',function(){
            var val = $("#wechat_menu_type").val();
            var nUrl = window.helper.putUrlParam( window.location.href.toString(), 'type', val);
            window.location.href = nUrl;
        });

        $('#wechat_menu_content_category_id').bind('change',function(){
            var val = $("#wechat_menu_content_category_id").find("option:selected").text();
            $("#wechat_menu_content_category_name").val(val);
        });

    </script>
@endsection