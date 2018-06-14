@extends('backend.layouts.app')

@section('title', $title = $category->id ? '编辑分类' : '添加分类' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">内容管理</a>
    <a href="">@switch($type)
            @case('article')文章分类@break
        @endswitch</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')

    @php
        $categoryHandler = app(\App\Handlers\CategoryHandler::class);
        $categoryItems = $categoryHandler->select($categoryHandler->getCategorys($type));
    @endphp

    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" method="POST" action="{{ $category->id ? route('administrator.category.update', [$category->id, $type]) : route('administrator.category.store', $type) }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="{{ $category->id ? 'PUT' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label">父级</label>
                <div class="layui-input-block">
                    <select name="parent">
                        <option value=""></option>
                        <option @if($parent == 0) selected @endif value="0">/</option>
                        @foreach($categoryItems as $key => $value)
                            <option @if($parent == $key) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入名称" class="layui-input" value="{{ old('name',$category->name) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">关键字</label>
                <div class="layui-input-block">
                    <input type="text" name="keywords" lay-verify="" autocomplete="off" placeholder="请输入关键字" class="layui-input" value="{{ old('keywords',$category->keywords) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                    <input type="number" name="order" lay-verify="" autocomplete="off" placeholder="请输入排序" class="layui-input" value="{{ old('order',$category->order) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">链接</label>
                <div class="layui-input-block">
                    <input type="text" name="link" lay-verify="" autocomplete="off" placeholder="请输入链接" class="layui-input" value="{{ old('link',$category->link) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">自定义模板</label>
                <div class="layui-input-block">
                    <input type="text" name="template" lay-verify="" placeholder="自定义模板" class="layui-input" value="{{ old('template', $category->template) }}" >
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea name="description" lay-verify="" placeholder="请输入描述" class="layui-textarea">{{  old('description', $category->description) }}</textarea>
                </div>
            </div>

            <div class="layui-form-item">
                {{--<div class="layui-input-block">--}}
                <input type="hidden" name="type" value="{{$type}}">
                {{--<input type="hidden" name="parent" value="{{$parent}}">--}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                {{--</div>--}}
            </div>
        </form>
    </div>
@endsection

@section('scripts')
@endsection