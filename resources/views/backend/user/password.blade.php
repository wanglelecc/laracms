@extends('backend.layouts.app')

@section('title', $title = '修改密码')

@section('breadcrumb')
    <a href="">系统设置</a>
    <a href="">用户管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
<div class="layui-main">

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>{{$title}}</legend>
    </fieldset>

    <form class="layui-form layui-form-pane" method="POST" action="{{ route('administrator.password.update', Auth::user()->id)  }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">

        <div class="layui-form-item">
            <label class="layui-form-label">原密码</label>
            <div class="layui-input-block">
                <input type="password" name="old_password" lay-verify="required" autocomplete="off" placeholder="原密码" class="layui-input" value="{{ old('old_password') }}" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">新密码</label>
            <div class="layui-input-block">
                <input type="password" name="password" lay-verify="required" placeholder="新密码" autocomplete="off" class="layui-input" value="{{ old("password")  }}" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">重复密码</label>
            <div class="layui-input-block">
                <input type="password" name="password_confirmation" lay-verify="required" placeholder="重复密码" autocomplete="off" class="layui-input" value="{{ old("password_confirmation") }}" >
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
