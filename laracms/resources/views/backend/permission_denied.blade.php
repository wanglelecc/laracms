<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>无权限访问 - {{ config('app.name', 'LaraCMS')  }}</title>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token()
        ]) !!};
    </script>
    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{asset('vendor/laracms/plugins/layui/css/layui.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/laracms/css/administrator.css')}}" rel="stylesheet" type="text/css">
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
    <br />
    <br />

    <div class="alone-banner">
        <div class="layui-main">
            @if (Auth::check())
                <h1>无权限操作</h1>
                <p class="layui-hide-xs">如需继续操作，请联系管理员授权后再继续操作。</p>
            @else
                <h1>未登录系统</h1>
                <p class="layui-hide-xs">如需继续操作，请先登录后再继续操作。</p>
            @endif
        </div>
    </div>

    <div class="alone-preview">
        <p class="alone-download-btn">
            @if (Auth::check())
                <a href="{{ route('administrator.dashboard')  }}" class="layui-btn">控制台</a>
            @else
                <a href="{{ route('administrator.login')  }}" class="layui-btn">登录</a>
            @endif
            <a href="{{ url()->previous() }}" class="layui-btn layui-btn-primary alone-download-right">返回</a>
        </p>
    </div>

</div>

<!-- Scripts -->
<script src="{{asset('vendor/laracms/plugins/layui/layui.all.js')}}"></script>
<script src="{{asset('vendor/laracms/js/administrator.js')}}"></script>

@include('backend::layouts._message')

@include('backend::layouts._error')

@yield('scripts')
</body>
</html>
