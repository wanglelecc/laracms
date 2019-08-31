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
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/laracms/plugins/zui/css/zui.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/laracms/plugins/zui/lib/bootbox/bootbox.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/laracms/plugins/zui/lib/chosen/chosen.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/laracms/plugins/formvalidation/css/formValidation.min.css')}}">
        <link rel="stylesheet" href="{{asset('vendor/laracms/plugins/zui/lib/uploader/zui.uploader.min.css')}}">
        <link rel="stylesheet" href="{{asset('vendor/laracms/plugins/webuploader/webuploader.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/laracms/css/app.css')}}">
        <link rel="apple-touch-icon" href="/favicon.png">
        @yield('styles')
    </head>
    <body class="{{ route_class() }}-body">

        <div id="app" class="{{ route_class() }}-page">
            <div class="wrapper">
                @include('backend::layouts._header')
                @include('backend::layouts._side')
                <div class="content-wrapper {{ route_class() }}-content">
                    <div class="content-header">
                        @includeWhen($breadcrumb ?? true, 'backend::layouts._breadcrumb')
                    </div>
                    <div class="content-body">
                        <div class="container-fluid">
                            @yield('tab')
                            @include('backend::layouts._message')
                            @include('backend::layouts._error')
                            @yield('content')
                        </div>
                    </div>
                    @include('backend::layouts._footer')
                </div>
            </div>
        </div>

        <!-- Delete Form -->
        <form id="form-delete" action="" method="POST" style="display:none;">
            <input type="hidden" name="_method" value="DELETE">
            {{ csrf_field() }}
        </form>

        <!-- Scripts -->
        <script src="{{asset('vendor/laracms/js/app.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/zui/js/zui.min.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/zui/lib/bootbox/bootbox.min.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/zui/lib/chosen/chosen.min.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/zui/lib/uploader/zui.uploader.min.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/zui/lib/sortable/zui.sortable.min.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/webuploader/webuploader.min.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/formvalidation/js/formValidation.min.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/formvalidation/js/framework/bootstrap.min.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/formvalidation/js/language/zh_CN.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/aliyun/es6-promise.min.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/aliyun/aliyun-oss-sdk-5.2.0.min.js')}}"></script>
        <script src="{{asset('vendor/laracms/plugins/aliyun/aliyun-upload-sdk-1.4.0.min.js')}}"></script>

        @yield('scripts')
        <script>
            /**
             * 表单验证
             *
             * @type {jQuery.fn.init|*|jQuery|HTMLElement}
             */
            var formValidator = $('#form-validator');
            if(formValidator){
                formValidator.formValidation({
                    framework: 'bootstrap',
                    locale: 'zh_CN',
                    message: '值无效',
                    icon: {
                        valid: 'glyphicon glyphicon-ok', // icon icon-check
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    }
                });
            }

            /**
             * 内容删除按钮
             */
            $("a.form-delete").click(function(){
                var tUrl = $(this).attr('data-url');

                bootbox.confirm({
                    size: "small",
                    title: "系统提示",
                    message: "确认删除吗？",
                    callback: function(result){ if(result === true){ $("form#form-delete").attr("action",tUrl).submit(); } }
                });

                return false;
            });

            $('select.chosen-select').chosen({
                no_results_text: '没有找到',    // 当检索时没有找到匹配项时显示的提示文本
                disable_search_threshold: 10, // 10 个以下的选择项则不显示检索框
                search_contains: true         // 从任意位置开始检索
            });



        </script>

    </body>
</html>
