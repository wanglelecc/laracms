@extends('layouts.app')

@section('title')登录@endsection

@section('content')

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />

    <div class="layui-row">
        <div class="layui-col-md4 layui-col-md-offset4">
            <div class="login-title">{{ config('app.name') }}</div>
        </div>
    </div>

    <div class="layui-row">
        <div class="layui-col-md4 layui-col-md-offset4">
            <div class="grid-login">
                <div class="login-form">
                    <form class="layui-form layui-form-pane"  method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="layui-form-item">
                            <input id="email" type="email" name="email" lay-verify="required|email" autocomplete="off" placeholder="邮箱" value="{{ old('email') }}" autofocus class="layui-input">
                        </div>
                        <div class="layui-form-item">
                            <input type="password" name="password" lay-verify="pass" autocomplete="off" placeholder="密码" class="layui-input">
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <input type="text" name="captcha" lay-verify="required" autocomplete="off" placeholder="验证码"  class="layui-input">
                            </div>
                            <div class="layui-inline">
                                <img class="thumbnail captcha" src="{{ captcha_src('login') }}" onclick="this.src='/captcha/login?'+Math.random()" title="点击图片重新获取验证码">
                            </div>
                        </div>

                        <div class="layui-form-item">

                        </div>

                        <div class="layui-form-item">
                              <input type="checkbox" name="remember" lay-skin="primary" title="记住我" {{ old('remember') ? 'checked' : '' }}>
                        </div>

                        <div class="layui-form-item">
                            <button type="submit" class="layui-btn  layui-btn-fluid" lay-submit="" lay-filter="login">登录</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

