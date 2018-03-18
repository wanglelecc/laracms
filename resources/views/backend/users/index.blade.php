@extends('backend.layouts.app')

@section('title', $title = '用户列表')

@section('breadcrumb')
    <a href="">系统设置</a>
    <a href="">用户管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
<div class="layui-main">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>{{$title}}</legend>
    </fieldset>

    <a href="{{ route('users.create') }}" class="layui-btn">添加</a>

    <div class="layui-form">
        @if($users->count())
        <table class="layui-table">
            <colgroup>
                <col width="50">
                <col width="150">
                <col width="150">
                <col>
                <col>
                <col width="110">
                <col width="80">
                <col width="300">
            </colgroup>
            <thead>
            <tr>
                <th>#</th>
                <th>用户名</th>
                <th>邮箱</th>
                <th>角色</th>
                <th>简介</th>
                <th>注册时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name  }}</td>
                <td>{{ $user->email  }}</td>
                <td>{{ implode(',',$user->roles()->pluck('remarks', 'name')->toArray()) }}</td>
                <td>{{ $user->introduction  }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>@switch($user->status)
                        @case(0)未激活@break
                        @case(1)正常@break
                        @case(2)封禁@break
                    @endswitch</td>
                <td>
                    <a href="{{ route('administrator.users.password.edit', $user->id) }}" class="layui-btn layui-btn-sm">重置密码</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                    <a href="javascript:;" data-url="{{ route('users.destroy', $user->id) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
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
    @include('backend.layouts._paginate',[ 'count' => $users->total(), ])
@endsection