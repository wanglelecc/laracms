<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>亲，内部服务器错误！</title>
    <link href="{{asset('vendor/laracms/plugins/layui/css/layui.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/laracms/css/website.css')}}" rel="stylesheet" type="text/css">
    <link rel="apple-touch-icon" href="/favicon.ico">
    <link rel="shortcut icon" href=" /favicon.ico" />
    <style>
        .notice{width: 600px; margin: 30px auto; padding: 30px 15px; border-top: 5px solid #009688; line-height: 30px;  text-align: center; font-size: 16px; font-weight: 300; background-color: #f2f2f2;}
        @media screen and (max-width: 750px) {html body{margin-top: 0;} .notice{width: auto; margin: 20px 15px; padding: 30px 0;} }
    </style>
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
</head>
<body>
    <div class="fly-none" style="min-height: 0; padding: 0;">
        <i class="iconfont icon-tishilian"></i>
    </div>
    <div class="notice layui-text">
        {{ $exception->getMessage() }}
    </div>
</body>
</html>
