<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>登录 - {{ config('app.name', 'LaraCMS')  }}</title>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token()
        ]) !!};
    </script>
    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{asset('vendor/laracms/plugins/zui/css/zui.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/laracms/css/app.css')}}" rel="stylesheet" type="text/css">
    <link rel="apple-touch-icon" href="/favicon.png">

    <style>
        body{background-color:#f6f5f5;padding-top: 0;}
        .user-control-nav{margin-bottom: 20px;}
        .page-content{padding: 0;}
        .text-bold{font-weight: bold;}
        .container {margin: 10% auto 0 auto}

        #login {margin: 0 auto; _width: 420px; min-height: 230px; background-color: #fff; border: 1px solid #dfdfdf; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; -moz-box-shadow: 0px 1px 15px rgba(0,0,0,0.15); -webkit-box-shadow: 0px 1px 15px rgba(0, 0, 0, 0.15); box-shadow: 0px 1px 15px rgba(0, 0, 0, 0.15)}
        #login .panel-head {min-height: 55px; background-color: #edf3fe; border-bottom: 1px solid #dfdfdf; position: relative}
        #login .panel-head h4 {margin: 0 0 0 20px; padding: 0; line-height: 55px; font-size: 14px}
        #login .panel-actions {float: right; position: absolute; right: 15px; top: 12px; padding: 0}
        #login .panel-actions .dropdown {display: inline-block; margin-right: 2px}
        #login #submit {min-width: 100px;}
        #loginForm {padding: 20px 20px;}
        .table-form th{ text-align: right;  vertical-align: middle;}
        .table-form th, .table-form td {padding: 8px 5px; border:none;}
        .notice {padding: 10px;}

    </style>

    @yield('styles')
</head>
<body class="layui-container {{ route_class() }}-body">

<div id="app" class="{{ route_class() }}-page">

    <div class='container'>

        <div class="col-md-6 col-md-offset-3">
        <div id='login'>
            <div class='panel-head'>
                <h4>{{ config('app.name') }} 管理系统</h4>
            </div>
            <div class="panel-body" id="loginForm">

                {{--@include('backend::layouts._message')--}}
                {{--@include('backend::layouts._error')--}}
                 <form class="form-horizontal"  method="POST" action="{{ route('administrator.login') }}">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email" class="col-sm-3 required">邮箱</label>
                        <div class="col-sm-8 @if ($errors->has('email')) has-error @endif">
                            <input type="email" name="email" autocomplete="off" required class="form-control" id="email" placeholder="请输入邮箱">
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 required">密码</label>
                        <div class="col-sm-8 @if ($errors->has('password')) has-error @endif">
                            <input type="password"  name='password' autocomplete="off" required class="form-control" id="password" placeholder="请输入密码">
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="captcha" class="col-sm-3 required">验证码</label>
                        <div class="col-sm-4 @if ($errors->has('captcha')) has-error @endif">
                            <input type="text" name="captcha" autocomplete="off" required class="form-control" id="captcha" placeholder="请输入验证码">
                            @if ($errors->has('captcha'))
                                <span class="help-block">
                                <strong>{{ $errors->first('captcha') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-sm-4">
                            <img class="img-rounded captcha" src="{{ captcha_src('login') }}" onclick="this.src='{{ captcha_src("login") }}?'+Math.random()" title="点击图片重新获取验证码">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8">
                            <button type="submit" class="btn btn-primary">登录</button>&nbsp;&nbsp;
                            <label><input type="checkbox" name='remember' {{ old('remember') ? 'checked' : '' }}> 记住我</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>

        <div class='notice text-center'>
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="{{asset('vendor/laracms/js/app.js')}}"></script>
@yield('scripts')
</body>
</html>
