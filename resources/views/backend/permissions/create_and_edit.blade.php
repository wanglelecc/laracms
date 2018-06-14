@extends('backend.layouts.app')

@section('title', $title = $permission->id ? '编辑权限' : '添加权限' )

@section('breadcrumb')
    <a href="">系统设置</a>
    <a href="">权限管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" method="POST" action="{{ $permission->id ? route('permissions.update', $permission->id) : route('permissions.store') }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="{{ $permission->id ? 'PATCH' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label">权限名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入名称" class="layui-input" value="{{ old('name',$permission->name) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">权限备注</label>
                <div class="layui-input-block">
                    <input type="text" name="remarks" lay-verify="required" autocomplete="off" placeholder="请输入备注" class="layui-input" value="{{ old('remarks',$permission->remarks) }}" >
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

@section('scripts')
@endsection