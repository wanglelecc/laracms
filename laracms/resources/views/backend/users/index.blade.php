@extends('backend::layouts.app')

@section('title', $title = '用户列表')

@section('breadcrumb')
    <li><a href="javascript:;">系统设置</a></li>
    <li><a href="javascript:;">用户管理</a></li>
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
                    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                </div>
            </div>

            @if($users->count())
            <table class="table table-bordered">
                    <colgroup>
                        <col width="50">
                        <col width="150">
                        <col width="150">
                        <col>
                        <col>
                        <col width="120">
                        <col width="120">
                        <col width="150">
                        <col width="80">
                        <col width="200">
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">用户名</th>
                        <th class="text-center">邮箱</th>
                        <th class="text-center">角色</th>
                        <th class="text-center">简介</th>
                        <th class="text-center">注册时间</th>
                        <th class="text-center">最后登录</th>
                        <th class="text-center">地点</th>
                        <th class="text-center">状态</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td class="text-center">{{ $user->id }}</td>
                            <td class="text-center">{{ $user->name  }}</td>
                            <td class="text-center">{{ $user->email  }}</td>
                            <td>{{ implode(',',$user->roles()->pluck('remarks', 'name')->toArray()) }}</td>
                            <td>{{ $user->introduction  }}</td>
                            <td class="text-center">{{ $user->created_at->toDateString() }}</td>
                            <td class="text-center">@if($user->last_at){{ $user->last_at->toDateString()}}@endif</td>
                            <td class="text-center">{{ $user->last_location }}</td>
                            <td class="text-center">@switch($user->status)
                                    @case(0)<span class="label label-badge">未激活</span>@break
                                    @case(1)<span class="label label-badge label-success">正常</span>@break
                                    @case(2)<span class="label label-badge label-danger">停用</span>@break
                                @endswitch</td>
                            <td class="text-center">
                                <a href="{{ route('administrator.users.password.edit', $user->id) }}" class="btn btn-xs btn-warning">重置密码</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-xs btn-primary">编辑</a>
                                <a href="javascript:;" data-url="{{ route('users.destroy', $user->id) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div id="paginate-render">
                    {{$users->links('pagination::backend')}}
                </div>
            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
@endsection