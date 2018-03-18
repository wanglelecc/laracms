@extends('backend.layouts.app')

@section('title', $title = '页面列表')

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">页面管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
<div class="layui-main">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>{{$title}}</legend>
    </fieldset>

    <a href="{{ route('pages.create') }}" class="layui-btn">添加</a>

    <div class="layui-form">
        @if($pages->count())
        <table class="layui-table">
            <colgroup>
                <col width="50">
                <col width="60">
                <col>
                <col width="100">
                <col width="130">
                <col width="100">
                <col width="130">
                <col width="100">
                <col width="60">
                <col width="300">
            </colgroup>
            <thead>
            <tr>
                <th>#</th>
                <th>排序</th>
                <th>标题</th>
                <th>作者</th>
                <th>添加时间</th>
                <th>添加人</th>
                <th>更新时间</th>
                <th>更新人</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $index => $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->order  }}</td>
                <td>{{ $page->title  }}</td>
                <td>{{ $page->author  }}</td>
                <td>{{ $page->created_at->diffForHumans()}}</td>
                <td>{{ $page->created_user->name}}</td>
                <td>{{ $page->updated_at->diffForHumans()}}</td>
                <td>{{ $page->updated_user->name}}</td>
                <td>@switch($page->status)
                        @case(0)隐藏@break
                        @case(1)正常@break
                        @case(2)封禁@break
                    @endswitch</td>
                <td>
                    <a href="{{ route('pages.edit', $page->id) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                    <a href="javascript:;" data-url="{{ route('pages.destroy', $page->id) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
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
    @include('backend.layouts._paginate',[ 'count' => $pages->total(), ])
@endsection