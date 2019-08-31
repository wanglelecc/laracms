@extends('backend::layouts.app')

@section('title', $title = '友情链接列表')

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li><a href="javascript:;">友情链接</a></li>
    <li>{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">

            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                </div>
                <div class="tools-group">
                    <a href="{{ route('links.create') }}" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                </div>
            </div>

            @if($links->count())
                <table class="table table-bordered">
                    <colgroup>
                        <col width="50">
                        <col width="60">
                        <col width="220">
                        <col width="220">
                        <col>
                        <col width="100">
                        <col width="70">
                        <col width="120">
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">排序</th>
                        <th class="text-center">名称</th>
                        <th class="text-center">LOGO</th>
                        <th class="text-center">链接</th>
                        <th class="text-center">打开方式</th>
                        <th class="text-center">状态</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($links as $index => $link)
                        <tr>
                            <td class="text-center">{{ $link->id }}</td>
                            <td class="text-center">{{ $link->order}}</td>
                            <td class="text-center">{{ $link->name}}</td>
                            <td class="text-center"><img src="{{ storage_image_url($link->image) }}" style="max-width: 200px; height: 60px;" /></td>
                            <td>{{ $link->url}}</td>
                            {{--<td>{{ $link->icon}}</td>--}}
                            <td class="text-center">@switch($link->target)
                                    @case('_self')<span class="label label-badge label-primary">当前窗口</span>@break
                                    @case('_blank')<span class="label label-badge  label-success">新开窗口</span>@break
                                @endswitch</td>
                            <td class="text-center">@switch($link->status)
                                    @case(0)<span class="label label-badge label-danger">隐藏</span>@break
                                    @case(1)<span class="label label-badge label-success">正常</span>@break
                                @endswitch</td>
                            <td class="text-center">
                                <a href="{{ route('links.edit', $link->id) }}" class="btn btn-xs btn-primary">编辑</a>
                                <a href="javascript:;" data-url="{{ route('links.destroy', $link->id) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            <div id="paginate-render">
                {{$links->links('pagination::backend')}}
            </div>
            @else
            <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')

@endsection