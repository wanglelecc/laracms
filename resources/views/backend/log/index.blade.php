@extends('backend::layouts.app')

@section('title', $title)

@section('breadcrumb')
    <a href="">开发调试</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')

@php
    $type = request('type', '');
    $keyword = request('keyword', '');
    $begin_time = request('begin_time', '');
    $end_time = request('end_time', '');
@endphp

<div class="layui-main">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>{{$title}}</legend>
    </fieldset>

    <form class="layui-form layui-form-pane" method="GET" action="">
    <div class="layui-form-item">
        <div style="">
        <div class="layui-inline">
            <label class="layui-form-label">日志分类</label>
            <div class="layui-input-block">
                <select name="type" lay-filter="log_type">
                    <option value=""></option>
                    @foreach($types as $item)
                    <option @if($type == $item->type) selected @endif value="{{$item->type}}">{{$item->type}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!--
        <div class="layui-inline">
            <label class="layui-form-label">开始时间</label>
            <div class="layui-input-inline">
                <input type="text" id="begin_time" name="begin_time" autocomplete="off" class="layui-input" value="{{$begin_time}}">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">结束时间</label>
            <div class="layui-input-inline">
                <input type="text" id="end_time" name="end_time" autocomplete="off" class="layui-input" value="{{$end_time}}">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">关键词</label>
            <div class="layui-input-inline">
                <input type="text" name="keyword" lay-verify="email" autocomplete="off" value="{{$keyword}}" class="layui-input">
            </div>
            <input type="hidden" name="page" value="{{request('page',1)}}">
            <button type="submit" class="layui-btn layui-btn-normal">搜索</button>
        </div>
        -->
    </div>
    </div>
    </form>



    <div class="layui-form">
        @if($logs->count())
        <form name="form-article-list" id="form-article-list" class="layui-form layui-form-pane" method="POST" action="">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <table class="layui-table">
            <colgroup>
                <col width="50">
                <col width=85">
                <col width="100">
                <col width="100">
                <col width="135">
                <col width="180">
                <col width="">
                <col width="180">
            </colgroup>
            <thead>
            <tr>
                <th>#</th>
                <th>类型</th>
                <th>用户</th>
                <th>浏览器</th>
                <th>IP</th>
                <th>地址</th>
                <th>内容</th>
                <th>操作时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $index => $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->type }}</td>
                <td>{{ $log->account }}</td>
                <td>{{ $log->browser }}</td>
                <td>{{ $log->ip }}</td>
                <td>{{ $log->location }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </form>
        <form id="delete-form" action="" method="POST" style="display:none;">
            <input type="hidden" name="_method" value="DELETE">
            {{ csrf_field() }}
        </form>
        <div id="paginate-render"></div>
        @else
            <br />
            <blockquote class="layui-elem-quote">暂无数据!</blockquote>
        @endif

    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript">
        layui.form.on('select(log_type)', function(data){
            var nUrl = window.jsUrlHelper.putUrlParam( window.location.href.toString(), 'type', data.value);
            window.location.href = nUrl;
        });

        layui.laydate.render({
            elem: '#begin_time'
        });

        layui.laydate.render({
            elem: '#end_time'
        });

    </script>
    @include('backend::layouts._paginate',[ 'count' => $logs->total(), ])
@endsection