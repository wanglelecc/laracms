@extends('backend.layouts.app')

@section('title', $title = '角色列表')

@section('breadcrumb')
    <a href="">系统设置</a>
    <a href="">角色管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
<div class="layui-main">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>{{$title}}</legend>
    </fieldset>

    <a href="{{ route('roles.create') }}" class="layui-btn">添加</a>

    <div class="layui-form">
        @if($roles->count())
        <table class="layui-table">
            <colgroup>
                <col width="50">
                <col>
                <col>
                <col width="300">
            </colgroup>
            <thead>
            <tr>
                <th>#</th>
                <th>角色名称</th>
                <th>角色备注</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $index => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name  }}</td>
                <td>{{ $role->remarks  }}</td>
                <td>
                    <a href="{{ route('roles.edit', $role->id) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                    <a href="javascript:;" data-url="{{ route('roles.destroy', $role->id) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
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
    @include('backend.layouts._paginate',[ 'count' => $roles->total(), ])
@endsection