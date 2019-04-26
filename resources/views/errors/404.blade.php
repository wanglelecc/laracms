<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>对不起，您访问的页面不存在！</title>
    <link href="{{asset('vendor/laracms/plugins/layui/css/layui.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/laracms/css/website.css')}}" rel="stylesheet" type="text/css">
    <link rel="apple-touch-icon" href="/favicon.ico">
    <link rel="shortcut icon" href=" /favicon.ico" />
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
</head>
<body>
<div class="fly-none" style="min-height: 0; padding: 0;">
    <h2><i class="iconfont icon-404"></i></h2>
    <p>抱歉！页面无法访问……</p>
</div>
</body>
</html>