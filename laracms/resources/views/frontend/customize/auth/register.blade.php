@extends('frontend::layouts.app')

@section('title', $title = '注册')

@section('breadcrumb')
    <a><cite>{{$title}}</cite></a>
@endsection

@section('content')

    <div class="layui-container fly-marginTop">
        <div class="fly-panel fly-panel-user" pad20>
            <div class="layui-tab layui-tab-brief" lay-filter="user">
                <ul class="layui-tab-title">
                    <li><a href="{{route('login')}}">登入</a></li>
                    <li class="layui-this">注册</li>
                </ul>
                <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-form layui-form-pane">
                            <form class="layui-form layui-form-pane" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="layui-form-item">
                                    <label for="L_username" class="layui-form-label">用户名</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="L_username" name="name" required lay-verify="required"  value="{{ old('name') }}" autofocus autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label for="L_email" class="layui-form-label">邮箱</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="L_email" name="email" required lay-verify="required|email" value="{{ old('email') }}" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">将会成为您唯一的登入名</div>
                                </div>
                                <div class="layui-form-item">
                                    <label for="L_pass" class="layui-form-label">密码</label>
                                    <div class="layui-input-inline">
                                        <input type="password" id="L_pass" name="password" required lay-verify="required" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">6到16个字符</div>
                                </div>
                                <div class="layui-form-item">
                                    <label for="L_repass" class="layui-form-label">确认密码</label>
                                    <div class="layui-input-inline">
                                        <input type="password" id="L_repass" name="password_confirmation" required lay-verify="required" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label for="L_vercode" class="layui-form-label">验证码</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="L_vercode" name="captcha" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="-layui-form-mid">
                                        <span style="color: #c00;"><img class="thumbnail captcha" src="{{ captcha_src('login') }}" onclick="this.src='/captcha/login?'+Math.random()" title="点击图片重新获取验证码"></span>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <button class="layui-btn" type="submit" -lay-filter="*" -lay-submit>立即注册</button>
                                </div>
                                <div class="layui-form-item fly-form-app">
                                    <span>或者直接使用社交账号快捷注册</span>
                                    <a href="{{route('oauth.login','qq')}}" onclick="layer.msg('正在通过QQ登录', {icon:16, shade: 0.1, time:0})" class="iconfont icon-qq" title="QQ登录"></a>
                                    <a href="{{route('oauth.login','weibo')}}" onclick="layer.msg('正在通过微博登录', {icon:16, shade: 0.1, time:0})" class="iconfont icon-weibo" title="微博登录"></a>
                                    <a href="{{route('oauth.login','github')}}" onclick="layer.msg('正在通过Github登录', {icon:16, shade: 0.1, time:0})" class="iconfont icon-github" title="Github登录"></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
