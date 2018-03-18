<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>对不起，您访问的页面不存在！</title>
    <style type="text/css">body{background-color:#ececec;font-family:"Helvetica Neue", Helvetica, "PingFang SC", 微软雅黑, Tahoma, Arial, sans-serif;font-size:14px;color:#3c3c3c}.error p:first-child{text-align:center;font-size:150px;font-weight:bold;line-height:100px;letter-spacing:5px;color:#fff}.error p:first-child span{cursor:pointer;text-shadow:0 0 2px #686868,0px 1px 1px #ddd,0px 2px 1px #d6d6d6,0px 3px 1px #ccc,0px 4px 1px #c5c5c5,0px 5px 1px #c1c1c1,0px 6px 1px #bbb,0px 7px 1px #777,0px 8px 3px rgba(100,100,100,0.4),0px 9px 5px rgba(100,100,100,0.1),0px 10px 7px rgba(100,100,100,0.15),0px 11px 9px rgba(100,100,100,0.2),0px 12px 11px rgba(100,100,100,0.25),0px 13px 15px rgba(100,100,100,0.3);-webkit-transition:all .1s linear;transition:all .1s linear}.error p:first-child span:hover{text-shadow:0 0 2px #686868,0px 1px 1px #fff,0px 2px 1px #fff,0px 3px 1px #fff,0px 4px 1px #fff,0px 5px 1px #fff,0px 6px 1px #fff,0px 7px 1px #777,0px 8px 3px #fff,0px 9px 5px #fff,0px 10px 7px #fff,0px 11px 9px #fff,0px 12px 11px #fff,0px 13px 15px #fff;-webkit-transition:all .1s linear;transition:all .1s linear}.error p:not(:first-child){text-align:center;color:#666;font-size:18px;text-shadow:0 1px 0 #fff;letter-spacing:1px;line-height:2em;margin-top:-50px}function echo(stringA,stringB){var hello="你好";alert("hello world")}</style>
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
</head>
<body>
    <div class="error">
        <p><span>4</span><span>0</span><span>4</span></p>
        <p>抱歉！页面无法访问……</p>
    </div>
</body>
</html>
