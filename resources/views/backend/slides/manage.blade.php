@extends('backend::layouts.app')

@section('title', $title = $slideConfig['name'].'管理')

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">幻灯管理</a>
    <a href="">幻灯片</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">

            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                </div>
                <div class="tools-group">
                    <a href="{{ route('slides.create', $group) }}" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                    <a href="{{ route('slides.index') }}" class="btn btn-default"><i class="icon icon-arrow-left"></i> 返回幻灯片</a>
                </div>
            </div>
            @if($slides->count())
                <table class="table table-bordered">
                    <colgroup>
                        <col width="50">
                        <col width="60">
                        <col width="220">
                        <col>
                        <col>
                        <col width="100">
                        <col width="70">
                        <col width="120">
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">排序</th>
                        <th class="text-center">图片</th>
                        <th class="text-center">标题</th>
                        <th class="text-center">链接</th>
                        <th class="text-center">打开方式</th>
                        <th class="text-center">状态</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slides as $index => $slide)
                        <tr>
                            <td class="text-center">{{ $slide->id }}</td>
                            <td class="text-center">{{ $slide->order}}</td>
                            <td><img class="layui-upload-img" src="{{ storage_image_url($slide->image) }}" width="204" height="57"></td>
                            <td>{{ $slide->title}}</td>
                            <td>{{ $slide->link}}</td>
                            <td class="text-center">@switch($slide->target)
                                    @case('_self')<span class="label label-badge label-primary">当前窗口</span>@break
                                    @case('_blank')<span class="label label-badge  label-success">新开窗口</span>@break
                                @endswitch</td>
                            <td class="text-center">@switch($slide->status)
                                    @case(0)<span class="label label-badge label-danger">隐藏</span>@break
                                    @case(1)<span class="label label-badge label-success">正常</span>@break
                                @endswitch</td>
                            <td class="text-center">
                                <a href="{{ route('slides.edit', $slide->id) }}" class="btn btn-xs btn-primary">编辑</a>
                                <a href="javascript:;" data-url="{{ route('slides.destroy', $slide->id) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    @include('backend::layouts._paginate',[ 'count' => $slides->total(), ])
@endsection