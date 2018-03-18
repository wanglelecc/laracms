@extends('backend.layouts.app')

@section('title', $title = $slideConfig['name'].'管理')

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">幻灯管理</a>
    <a href="">幻灯片</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <a href="{{ route('slides.create', $group) }}" class="layui-btn">添加</a>
        <a href="{{ route('slides.index') }}" class="layui-btn layui-btn-primary">返回幻灯片</a>

        <div class="layui-form">
            @if($slides->count())
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="60">
                        <col width="130">
                        <col>
                        <col>
                        <col>
                        <col width="300">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>排序</th>
                        <th>图片</th>
                        <th>标题</th>
                        <th>链接</th>
                        {{--<th>图标</th>--}}
                        <th>打开方式</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slides as $index => $slide)
                        <tr>
                            <td>{{ $slide->id }}</td>
                            <td>{{ $slide->order}}</td>
                            <td><img class="layui-upload-img" src="{{ $slide->getImage() }}" width="104" height="57"></td>
                            <td>{{ $slide->title}}</td>
                            <td>{{ $slide->link}}</td>
                            {{--<td>{{ $link->icon}}</td>--}}
                            <td>@switch($slide->target)
                                    @case('_self')当前窗口@break
                                    @case('_blank')新开窗口@break
                                @endswitch</td>
                            <td>@switch($slide->status)
                                    @case(0)隐藏@break
                                    @case(1)显示@break
                                @endswitch</td>
                            <td>
                                <a href="{{ route('slides.edit', $slide->id) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                                <a href="javascript:;" data-url="{{ route('slides.destroy', $slide->id) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
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
    @include('backend.layouts._paginate',[ 'count' => $slides->total(), ])
@endsection