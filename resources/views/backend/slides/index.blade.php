@extends('backend.layouts.app')

@section('title', $title = '幻灯片')

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">幻灯管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        {{--<a href="{{ route('slides.create') }}" class="layui-btn">添加</a>--}}

        <div class="layui-form">
            @if($slides->count())
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="200">
                        <col width="300">
                        <col>
                        <col width="300">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>标识</th>
                        <th>名称</th>
                        <th>描述</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slides as $index => $slide)
                        <tr>
                            <td>{{ $slide['id'] }}</td>
                            <td>{{ $slide['mark']}}</td>
                            <td>{{ $slide['name']}}</td>
                            <td>{{ $slide['description']}}</td>
                            <td>
                                <a href="{{ route('slides.manage', $slide['id']) }}" class="layui-btn layui-btn-sm layui-btn-normal">管理</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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

@endsection