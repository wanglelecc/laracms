@extends('backend.layouts.app')

@section('title', $title = $role->id ? '编辑角色' : '添加角色' )

@section('breadcrumb')
    <a href="">系统设置</a>
    <a href="">角色管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" method="POST" action="{{ $role->id ? route('roles.update', $role->id) : route('roles.store') }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="{{ $role->id ? 'PATCH' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label">角色名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入名称" class="layui-input" value="{{ old('name',$role->name) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">角色备注</label>
                <div class="layui-input-block">
                    <input type="text" name="remarks" lay-verify="required" autocomplete="off" placeholder="请输入备注" class="layui-input" value="{{ old('remarks',$role->remarks) }}" >
                </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">权限</label>
                <div class="layui-input-block">
                    @foreach($permissions as $key => $val)
                    <input type="checkbox" name="permission[]" lay-skin="primary" value="{{ $val }}" title="{{ $key }}" @if(in_array($val,$rolePermissions)) checked="" @endif >
                    @endforeach
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