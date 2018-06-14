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
        <link href="{{asset('layui/css/layui.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/administrator.css')}}" rel="stylesheet" type="text/css">
        <link rel="apple-touch-icon" href="/favicon.png">
        @yield('styles')
    </head>
    <body  class="layui-layout {{ route_class() }}-body">

        <div id="app" class="layui-layout-admin {{ route_class() }}-page">

            @include('backend.layouts._header')

            @include('backend.layouts._side')

            <div class="layui-body  {{ route_class() }}-content">
                <div class="">
                @yield('tab')

                @includeWhen($breadcrumb ?? true, 'backend.layouts._breadcrumb')

                @yield('content')

                </div>
            </div>

            @include('backend.layouts._footer')

        </div>

        <!-- Scripts -->
        <script src="{{asset('layui/layui.all.js')}}"></script>
        <script src="{{asset('js/administrator.js')}}"></script>
        <script src="{{asset('js/jquery.cookie-1.4.1.min.js')}}"></script>
        <script>
            layui.form.verify({
                username: function(value, item){ //value：表单的值、item：表单的DOM对象
                    if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                        return '用户名不能有特殊字符';
                    }
                    if(/(^\_)|(\__)|(\_+$)/.test(value)){
                        return '用户名首尾不能出现下划线\'_\'';
                    }
                    if(/^\d+\d+\d$/.test(value)){
                        return '用户名不能全为数字';
                    }
                }

                //我们既支持上述函数式的方式，也支持下述数组的形式
                //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
                ,pass: [
                    /^[\S]{6,12}$/
                    ,'密码必须6到12位，且不能出现空格'
                ]
            });

            // layer.msg('的确很重要', {icon: 1});

            $(".layui-nav dd").click(function(){
                var id = $(this).attr('id');
                $.cookie('nav-id', id, { expires: 1, path: '/' });
            });

            $(".layui-nav-header dd").click(function(){
                $.cookie('nav-id', '', { expires: 1, path: '/' });
            });

            var NavId = $.cookie('nav-id');
            if(NavId){
               $("#"+NavId).addClass("layui-this");
            }

        </script>

        @include('backend.layouts._message')

        @include('backend.layouts._error')

        @yield('scripts')
    </body>
</html>
