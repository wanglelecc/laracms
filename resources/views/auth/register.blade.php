@extends('layouts.app')

@section('title')注册@endsection

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
            <div class="login-title">注册</div>
        </div>
    </div>

    <div class="layui-row">
        <div class="layui-col-md4 layui-col-md-offset4">
            <div class="grid-login">
                <div class="login-form">
                    <form class="layui-form layui-form-pane" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="layui-form-item">
                            <input id="name" type="text" lay-verify="required" class="layui-input" placeholder="用户名" name="name" value="{{ old('name') }}" required autofocus>
                        </div>

                        <div class="layui-form-item">
                            <input id="email" type="email"  lay-verify="required|email" class="layui-input" placeholder="邮箱" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="layui-form-item">
                            <input id="password" type="password" lay-verify="required" class="layui-input" placeholder="密码" name="password" required>
                        </div>

                        <div class="layui-form-item">
                             <input id="password-confirm" type="password" lay-verify="required" class="layui-input" placeholder="重复密码" name="password_confirmation" required>
                        </div>


                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <input id="captcha" class="layui-input" lay-verify="required" name="captcha" placeholder="验证码" >
                            </div>
                            <div class="layui-inline">
                                <img class="thumbnail captcha" src="{{ captcha_src('login') }}" onclick="this.src='/captcha/login?'+Math.random()" title="点击图片重新获取验证码">
                            </div>
                         </div>

                        <div class="layui-form-item">
                            <button type="submit" class="layui-btn  layui-btn-fluid" lay-submit="" lay-filter="login">注册</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
