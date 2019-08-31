<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'LaraCMS')) - {{ config('app.name', 'LaraCMS')  }}</title>
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
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{asset('vendor/laracms/plugins/layui/layui.all.js')}}"></script>
<script src="{{asset('vendor/laracms/js/administrator.js')}}"></script>

@include('backend.layouts._message')

@include('backend.layouts._error')

@yield('scripts')
</body>
</html>
