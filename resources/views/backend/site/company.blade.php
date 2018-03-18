@extends('backend.layouts.app')

@section('title', $title = '公司信息' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" method="POST" action="{{route('administrator.site.company')}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="POST">

            <div class="layui-form-item">
                <label class="layui-form-label">公司名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="" autocomplete="off" placeholder="公司名称" class="layui-input" value="{{ get_value($site, 'name') }}" >
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">公司简介</label>
                <div class="layui-input-block">
                    <textarea name="description" id="description" lay-verify="" placeholder="公司简介" class="layui-textarea editor">{{  get_value($site, 'description') }}</textarea>
                </div>
            </div>
            
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">公司介绍</label>
                <div class="layui-input-block">
                    <textarea name="content" id="statistics" lay-verify="" placeholder="公司介绍" class="layui-textarea editor">{{  get_value($site, 'content') }}</textarea>
                </div>
            </div>

            <div class="layui-form-item">
                {{--<div class="layui-input-block">--}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                {{--</div>--}}
            </div>
        </form>
    </div>
@endsection


@section('styles')
    @include('backend.common._editor_styles')
@stop

@section('scripts')
    @include('backend.common._editor_scripts',['folder'=>'company'])
@stop