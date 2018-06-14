@extends('backend.layouts.app')

@section('title', $title = $page->id ? '编辑页面' : '添加页面' )

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">页面管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" method="POST" action="{{ $page->id ? route('pages.update', $page->id) : route('pages.store') }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="{{ $page->id ? 'PATCH' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{ old('title',$page->title) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">副标题</label>
                <div class="layui-input-block">
                    <input type="text" name="subtitle" lay-verify="" autocomplete="off" placeholder="请输入副标题" class="layui-input" value="{{ old('subtitle',$page->subtitle) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">关键词</label>
                <div class="layui-input-block">
                    <input type="text" name="keywords" lay-verify="" autocomplete="off" placeholder="请输入关键词" class="layui-input" value="{{ old('keywords',$page->keywords) }}" >
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea name="description" lay-verify="" placeholder="描述" class="layui-textarea">{{  old('description', $page->description) }}</textarea>
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">内容</label>
                <div class="layui-input-block">
                    <textarea name="content" lay-verify="" id="content" placeholder="页面内容" class="layui-textarea editor">{{  old('content', $page->content) }}</textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">作者</label>
                <div class="layui-input-block">
                    <input type="text" name="author" lay-verify="" autocomplete="off" placeholder="请输入作者" class="layui-input" value="{{ old('author',$page->author) }}" >
                </div>
            </div>

            @if($page->id)
            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                    <input type="number" name="order" lay-verify="required" autocomplete="off" placeholder="请输入排序" class="layui-input" value="{{ old('order',$page->order) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">模板</label>
                <div class="layui-input-block">
                    <input type="text" name="template" lay-verify="" autocomplete="off" placeholder="请输入模板" class="layui-input" value="{{ old('template',$page->template) }}" >
                </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" lay-skin="primary" value="0" title="隐藏" @if($page->status == '0') checked="" @endif >
                    <input type="radio" name="status" lay-skin="primary" value="1" title="显示" @if($page->status == '1') checked="" @endif >
                </div>
            </div>
            @endif

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
    @include('backend.common._editor_scripts',['folder'=>'website'])
@stop