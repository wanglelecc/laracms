<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('system.common.basic.name', 'LaraCMS')) - {{ config('app.name', 'LaraCMS')  }}</title>
        <meta name="description" content="@yield('description', config('system.common.basic.description',''))">
        <meta name="Keywords" content="@yield('keywords', config('system.common.basic.keywords',''))">
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token()
        ]) !!};
        </script>
        <!-- Fonts -->

        <!-- Styles -->
        <link href="{{asset('layui/css/layui.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/app.desktop.css')}}" rel="stylesheet" type="text/css">
        <link rel="apple-touch-icon" href="/favicon.png">
        @yield('styles')
    </head>
    <body  class="{{ route_class() }}-body">

        <div id="app" class="{{ route_class() }}-page">

            @include('frontend.default.layouts._header')

            <div class="{{ route_class() }}-content">
                <div class="">
                    @yield('tab')
                    {{--@include('frontend.default.layouts._breadcrumb')--}}
                    @yield('content')
                </div>
            </div>

            @include('frontend.default.layouts._footer')

        </div>

        <!-- Scripts -->
        <script src="{{asset('layui/layui.all.js')}}"></script>
        <script src="{{asset('js/app.desktop.js')}}"></script>

        @include('frontend.default.layouts._message')

        @include('frontend.default.layouts._error')

        @yield('scripts')
    </body>
</html>
