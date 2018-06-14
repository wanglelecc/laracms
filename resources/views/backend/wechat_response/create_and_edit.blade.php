@extends('backend.layouts.app')

@php
    $group = isset($group) ? $group : 'keyword';
    if($group == 'keyword'){
        $title = $wechat_response->id ? '编辑回复' : '添加回复';
    }else if($group == 'default'){
        $title = '默认响应';
    }else if($group == 'subscribe'){
        $title = '订阅响应';
    }
@endphp

@section('title', $title )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">微信管理</a>
    <a href="">微信菜单</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
@php
    if($group == 'keyword'){
        $type = $wechat_response->type ?? request('type', 'text');
    }else{
        $type = request('type', $wechat_response->type ?? 'text');
    }

@endphp
<div class="layui-main">

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
    </fieldset>

    @if($group == 'keyword')
       <form class="layui-form layui-form-pane" method="POST" action="{{ $wechat_response->id ? route('wechat_response.update', [$wechat_response->id, $wechat->id]) : route('wechat_response.store', $wechat->id) }}?redirect={{ previous_url() }}">
         <input type="hidden" name="_method" value="{{ $wechat_response->id ? 'PUT' : 'POST' }}">
    @else
       <form class="layui-form layui-form-pane" method="POST" action="{{ route('wechat_response.set_response.store', [$wechat->id, $group]) }}">
         <input type="hidden" name="_method" value="POST">
    @endif
            {{ csrf_field() }}

            <input type="hidden" name="group" value="{{$group}}" />

            @if( ! $wechat_response->id)
            <input type="hidden" name="wechat_id" value="{{ old('wechat_id',$wechat->id) }}" >
            @else
            <input type="hidden" name="wechat_id" value="{{ old('wechat_id',$wechat_response->wechat_id) }}">
            @endif

            <div class="layui-form-item">
                <label class="layui-form-label">类型</label>
                <div class="layui-input-block">
                    @if($wechat_response->id && $group == 'keyword')
                        <input type="hidden" name="type" value="{{$type}}" />
                        <input type="text"  class="layui-input" disabled value="@switch($type)
                        @case('text') 文本 @break
                        @case('link') 链接 @break
                        @case('news') 图文 @break
                        @endswitch">
                    @else
                        <select name="type" lay-filter="wechat_response_type">
                            <option value=""></option>
                            <option @if($type == 'text') selected @endif value="text">文本</option>
                            <option @if($type == 'link') selected @endif value="link">链接</option>
                            <option @if($type == 'news') selected @endif value="news">图文</option>
                        </select>
                    @endif
                </div>
            </div>

           @if($group == 'keyword')
            <div class="layui-form-item">
                <label class="layui-form-label" for="key-field">关键字</label>
                <div class="layui-input-block">
                    <input type="text" name="key" id="key-field" lay-verify="required" autocomplete="off" placeholder="请输入关键字" class="layui-input" value="{{ old('key',$wechat_response->key) }}" >
                </div>
            </div>
           @else
               <input type="hidden" name="key" value="{{ $group }}" >
           @endif

            @if($type)
                @include('backend.wechat_response.template.'.$type,['wechat_response' => $wechat_response])
            @endif

            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
    </form>

</div>

@endsection

@section('scripts')
    <script type="text/javascript">
        layui.form.on('select(wechat_response_type)', function(data){
            var nUrl = window.jsUrlHelper.putUrlParam( window.location.href.toString(), 'type', data.value);
            window.location.href = nUrl;
        });

        layui.form.on('select(wechat_response_content_category_id)', function(data){
            $("#wechat_response_content_category_name").val($(data.elem).find("option:selected").text());
        });
    </script>
@endsection