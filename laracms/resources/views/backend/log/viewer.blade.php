@extends('backend::layouts.app')

@section('title', $title = '系统日志')

@section('breadcrumb')
    <a href="">开发调试</a>
    <a href="">{{$title}}</a>
@endsection

@php
    $breadcrumb = false;
@endphp

@section('content')
    <style>
        /*.layui-body{overflow-y: scroll;}*/
        body .site-demo-title{left: 360px}
        body .layui-layout-admin .site-demo{left: 160px; top:45px; bottom:0;}
    </style>
    <div class="layui-side layui-side-child">
        <div class="layui-side-scroll">
            <!-- 左侧子菜单 -->
            <ul class="layui-nav layui-nav-tree">
                @foreach($files as $file)
                    <li class="layui-nav-item @if ($current_file == $file) layui-this @endif"><a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
                       class="list-group-item" title="{{$file}}">{{$file}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="layui-tab layui-tab-brief site-demo-table" lay-filter="demoTitle">
        <ul class="layui-tab-title site-demo-title">
            <li class="layui-this">系统日志</li>
        </ul>
        <div class="layui-body layui-tab-content site-demo">

            <div class="layui-tab-item layui-show">
                <div class="layui-main">

                    <div id="LAY_preview">

                        <div class="demoTable">
                            搜索ID：
                            <div class="layui-inline">
                                <input class="layui-input" name="id" id="demoReload" autocomplete="off">
                            </div>
                            <button class="layui-btn" data-type="reload">搜索</button>
                        </div>

                        @if ($logs === null)
                            <div>
                                Log file >50M, please download it.
                            </div>
                        @else
                            <table id="table-log" class="table table-striped"  lay-filter="table-log">
                                <thead>
                                <tr>
                                    <th lay-data="{field:'Level',width:100, sort:true}">级别</th>
                                    <th lay-data="{field:'Context',width:100, sort:true}">上下文</th>
                                    <th lay-data="{field:'Date',width:200, sort:true}">时间</th>
                                    <th lay-data="{field:'Content',minWidth:200}">内容</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($logs as $key => $log)
                                    <tr data-display="stack{{{$key}}}">
                                        <td class="text-{{{$log['level_class']}}}"><span class="fa fa-{{{$log['level_img']}}}"
                                                                                         aria-hidden="true"></span> &nbsp;{{$log['level']}}</td>
                                        <td class="text">{{$log['context']}}</td>
                                        <td class="date">{{{$log['date']}}}</td>
                                        <td class="text">
                                            @if ($log['stack']) <button type="button" class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                                                                        data-display="stack{{{$key}}}"><span
                                                        class="fa fa-search"></span></button>@endif
                                            {{{$log['text']}}}
                                            @if (isset($log['in_file'])) <br/>{{{$log['in_file']}}}@endif
                                            @if ($log['stack'])
                                                <div class="stack" id="stack{{{$key}}}"
                                                     style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
                                                </div>@endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @endif

                        <div class="p-3">
                            @if($current_file)
                                <a class="layui-btn" href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}">下载文件</a>
                                <a class="layui-btn layui-btn-warm" id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}">删除文件</a>
                                @if(count($files) > 1)
                                    <a class="layui-btn layui-btn-danger" id="delete-all-log" href="?delall=true">删除全部文件</a>
                                @endif
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script>
    layui.use('table', function(){
        var table = layui.table;

        var $ = layui.$, active = {
            parseTable: function(){
                table.init('table-log', { //转化静态表格
                    height: 'full'
                    ,limit : 15
                    ,even:true
                    ,page:true
                });
            }
        };

        active['parseTable'].call(this);

        $('#delete-log, #delete-all-log').click(function () {
            var tUrl = $(this).attr('href');

            layer.confirm('确认删除吗？', {
                btn: ['确认', '取消']
            }, function(index){
                window.location.href = tUrl;
                layer.close(index);
                return false;
            }, function(index){
                layer.close(index);
                return true;
            });

            return false;
        });
    });
</script>
@endsection