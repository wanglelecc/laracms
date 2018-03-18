@extends('backend.layouts.app')

@section('title',$title = '控制台')

@section('breadcrumb')

@endsection

@section('content')
    <div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <blockquote class="layui-elem-quote">欢迎使用 LaraCMS 内容管理系统！</blockquote>

    </div>

@endsection
