@extends('backend::layouts.app')

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

@section('navigation')
    <a class="btn btn-primary btn-xs" href="{{ route('wechats.index') }}">微信管理</a>
@endsection

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li><a href="javascript:;">微信管理</a></li>
    <li><a href="javascript:;">微信菜单</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
@php
    if($group == 'keyword'){
        $type = $wechat_response->type ?? request('type', 'text');
    }else{
        $type = request('type', $wechat_response->type ?? 'text');
    }
@endphp

<h2 class="header-dividing">{{$title}} <small></small></h2>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                    @if($group == 'keyword')
                        <form id="form-validator" class="form-horizontal" method="POST" action="{{ $wechat_response->id ? route('wechat.response.update', [$wechat_response->id, $wechat->id]) : route('wechat.response.store', $wechat->id) }}">
                            <input type="hidden" name="_method" value="{{ $wechat_response->id ? 'PUT' : 'POST' }}">
                    @else
                        <form id="form-validator" class="form-horizontal" method="POST" action="{{ route('wechat.response.set.response.store', [$wechat->id, $group]) }}">
                            <input type="hidden" name="_method" value="POST">
                    @endif
                        {{ csrf_field() }}
                        <input type="hidden" name="group" value="{{$group}}" />
                        @if( ! $wechat_response->id)
                            <input type="hidden" name="wechat_id" value="{{ old('wechat_id',$wechat->id) }}" >
                        @else
                            <input type="hidden" name="wechat_id" value="{{ old('wechat_id',$wechat_response->wechat_id) }}">
                        @endif

                    <div class="form-group has-feedback  has-icon-right">
                        <label for="app_id" class="col-md-2 col-sm-2 control-label required">类型</label>
                        <div class="col-md-5 col-sm-10">
                        @if($wechat_response->id && $group == 'keyword')
                            <input type="hidden" name="type" value="{{$type}}" />
                            <input type="text"  class="form-control" disabled value="@switch($type)
                            @case('text') 文本 @break
                            @case('link') 链接 @break
                            @case('news') 图文 @break
                            @endswitch">
                        @else
                            <select name="type" class="form-control" id="wechat_response_type">
                                {{--<option value=""></option>--}}
                                <option @if($type == 'text') selected @endif value="text">文本</option>
                                <option @if($type == 'link') selected @endif value="link">链接</option>
                                <option @if($type == 'news') selected @endif value="news">图文</option>
                            </select>
                        @endif
                        </div>
                    </div>

                    @if($group == 'keyword')
                        <div class="form-group has-feedback  has-icon-right">
                            <label for="app_id" class="col-md-2 col-sm-2 control-label required">关键字</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="key" id="key-field" autocomplete="off" placeholder="" class="form-control" value="{{ old('key',$wechat_response->key) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>
                    @else
                        <input type="hidden" name="key" value="{{ $group }}" >
                    @endif

                    @if($type)
                        @include('backend::wechat.response.template.'.$type,['wechat_response' => $wechat_response])
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
        $('#wechat_response_type').bind('change',function(){
           var val = $("#wechat_response_type").val();
            var nUrl = window.helper.putUrlParam( window.location.href.toString(), 'type', val);
            window.location.href = nUrl;
        });

        $('#wechat_response_news_category_id').bind('change',function(){
            var val = $("#wechat_response_news_category_id").find("option:selected").text();
            $("#wechat_response_news_category_name").val(val);
        });

    </script>
@endsection