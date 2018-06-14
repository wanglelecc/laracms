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
    <link href="{{asset('layui/css/layui.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/administrator.css')}}" rel="stylesheet" type="text/css">
    <link rel="apple-touch-icon" href="/favicon.png">
    @yield('styles')
</head>
<body class="layui-container {{ route_class() }}-body">

<div id="app" class="layui-layout-admin {{ route_class() }}-page">

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
                    <form class="layui-form layui-form-pane"  method="POST" action="{{ route('administrator.login') }}">
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
</div>

<!-- Scripts -->
<script src="{{asset('layui/layui.all.js')}}"></script>
<script src="{{asset('js/administrator.js')}}"></script>
<script src="{{asset('js/jquery.cookie-1.4.1.min.js')}}"></script>
<script>
    $.cookie('nav-id', '', { expires: 1, path: '/' });
</script>

@include('backend.layouts._message')

@include('backend.layouts._error')

@yield('scripts')
</body>
</html>
