@extends('backend.layouts.app')

@section('title', $title = $user->id ? '编辑用户' : '添加用户' )

@section('breadcrumb')
    <a href="">系统设置</a>
    <a href="">用户管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" method="POST" action="{{ $user->id ? route('users.update', $user->id) : route('users.store') }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="{{ $user->id ? 'PATCH' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{ old('name',$user->name) }}" >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block">
                    <input type="email" name="email" lay-verify="required|email" placeholder="请输入" autocomplete="off" class="layui-input" value="{{ old('email',$user->email) }}" >
                </div>
            </div>

            @if(!$user->id)
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="text" name="password" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="{{ old('password',$user->password) }}" >
                </div>
            </div>
            @endif

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">角色</label>
                <div class="layui-input-block">
                    @foreach($roles as $key => $val)
                        <input type="checkbox" name="roles[]" lay-skin="primary" value="{{ $val }}" title="{{ $key }}" @if(in_array($val,$userRoles)) checked="" @endif >
                    @endforeach
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">个人简介</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" name="introduction" lay-verify="required" class="layui-textarea">{{ old('introduction',$user->introduction) }}</textarea>
                </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="0" @if(old('status',$user->status) == 0) checked="" @endif title="未激活" lay-verify="required">
                    <input type="radio" name="status" value="1" @if(old('status',$user->status) == 1) checked="" @endif title="正常" lay-verify="required">
                    <input type="radio" name="status" value="2" @if(old('status',$user->status) == 2) checked="" @endif title="停用" lay-verify="required">
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