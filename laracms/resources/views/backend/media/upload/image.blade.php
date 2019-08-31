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
<body  class="layui-layout {{ route_class() }}-body">

<div id="app" class="layui-layout-admin {{ route_class() }}-page">

    <div class="{{ route_class() }}-content">
        <div class="layui-main">
            <div class="layui-form">
                <br />
                <form class="layui-form layui-form-pane" method="GET" action="">
                    <input type="hidden" name="type" value="">
                    <div class="layui-form-item">
                        <div style="float:right;">
                            <div class="layui-inline">
                                <label class="layui-form-label" style="width: auto;">关键词</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="keyword" lay-verify="" autocomplete="off" value="" class="layui-input  layui-input-sm">
                                </div>
                                <input type="hidden" name="page" class="" value="{{request('page',1)}}">
                                <button type="submit" class="layui-btn layui-btn-normal">搜索</button>
                            </div>
                        </div>
                    </div>
                </form>

                @if($images->count())
                    <div class="layui-fluid layadmin-cmdlist-fluid">
                        <div class="layui-row layui-col-space30 layer-photos" id="layer-photos">
                            @foreach($images as $image)
                            <div class="layui-col-md2 layui-col-sm4">
                                <label for="upload">
                                    <div class="cmdlist-upload-container cmdlist-upload-container-active">
                                        <img src="{{$image->getImageUrl()}}" alt="{{$image->title}}">
                                    </div>
                                    <input type="radio" name="upload" data-uri="{{$image->getImageUrl()}}" data-path="{{$image->path}}" value="{{$image->path}}">
                                </label>
                            </div>
                            @endforeach
                            <div class="layui-col-md12 layui-col-sm12">
                                <div id="paginate-render"></div>
                            </div>
                        </div>
                    </div>
                @else
                    <br />
                    <blockquote class="layui-elem-quote">暂无数据!</blockquote>
                @endif

            </div>
        </div>
    </div>


</div>

<!-- Scripts -->
<script src="{{asset('vendor/laracms/plugins/layui/layui.all.js')}}"></script>
<script src="{{asset('vendor/laracms/js/administrator.js')}}"></script>

@include('backend::layouts._message')

@include('backend::layouts._error')

@include('backend::layouts._paginate',[ 'count' => $images->total(), ])
</body>
</html>


