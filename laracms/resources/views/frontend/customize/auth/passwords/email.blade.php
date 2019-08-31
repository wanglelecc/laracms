@extends('frontend::layouts.app')

@section('title', $title = '忘记密码')

@section('breadcrumb')
    <a><cite>{{$title}}</cite></a>
@endsection
@section('content')
<div class="layui-container fly-marginTop">
    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="user">
            <ul class="layui-tab-title">
                <li class="layui-this">{{$title}}</li>
            </ul>
            <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                <div class="layui-tab-item layui-show">
                    <div class="layui-form layui-form-pane">
                        <form class="layui-form layui-form-pane"  method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}
                            <div class="layui-form-item">
                                <label for="L_email" class="layui-form-label">邮箱</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_email" name="email" required lay-verify="required|email" autocomplete="off" value="{{ old('email') }}" autofocus class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_vercode" class="layui-form-label">验证码</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_vercode" name="captcha" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                </div>
                                <div class="-layui-form-mid">
                                    <span style="color: #c00;"> <img class="thumbnail captcha" src="{{ captcha_src('login') }}" onclick="this.src='/captcha/login?'+Math.random()" title="点击图片重新获取验证码"></span>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn" type="submit" -lay-filter="*" -lay-submit>下一步</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
