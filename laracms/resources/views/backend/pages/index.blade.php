@extends('backend::layouts.app')

@section('title', $title = '页面列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">页面管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">

            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                </div>
                <div class="tools-group">
                    <a href="{{ route('pages.create') }}"  class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                </div>
            </div>

             @if($pages->count())
                <table class="table table-bordered">
                    <colgroup>
                        <col width="50">
                        <col width="60">
                        <col>
                        <col width="100">
                        <col width="130">
                        <col width="100">
                        <col width="130">
                        <col width="100">
                        <col width="70">
                        <col width="120">
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">排序</th>
                        <th class="text-center">标题</th>
                        <th class="text-center">作者</th>
                        <th class="text-center">添加时间</th>
                        <th class="text-center">添加人</th>
                        <th class="text-center">更新时间</th>
                        <th class="text-center">更新人</th>
                        <th class="text-center">状态</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $index => $page)
                        <tr>
                            <td class="text-center">{{ $page->id }}</td>
                            <td class="text-center">{{ $page->order  }}</td>
                            <td>{{ $page->title  }}</td>
                            <td class="text-center">{{ $page->author  }}</td>
                            <td class="text-center">{{ $page->created_at->toDateString()}}</td>
                            <td class="text-center">{{ $page->created_user->name}}</td>
                            <td class="text-center">{{ $page->updated_at->toDateString()}}</td>
                            <td class="text-center">{{ $page->updated_user->name}}</td>
                            <td class="text-center">@switch($page->status)
                                    @case(0)<span class="label label-badge">隐藏</span>@break
                                    @case(1)<span class="label label-badge label-success">正常</span>@break
                                    @case(2)<span class="label label-badge label-danger">封禁</span>@break
                                @endswitch</td>
                            <td class="text-center">
                                <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-xs btn-primary">编辑</a>
                                <a href="javascript:;" data-url="{{ route('pages.destroy', $page->id) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div id="paginate-render">
                    {{$pages->links('pagination::backend')}}
                </div>
            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    @include('backend::layouts._paginate',[ 'count' => $pages->total(), ])
@endsection