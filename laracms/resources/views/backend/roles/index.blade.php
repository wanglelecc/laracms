@extends('backend::layouts.app')

@section('title', $title = '角色列表')

@section('breadcrumb')
    <li><a href="javascript:;">系统设置</a></li>
    <li><a href="javascript:;">角色管理</a></li>
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
                    <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                </div>
            </div>
            @if($roles->count())
                <table class="table table-bordered">
                    <colgroup>
                        <col width="50">
                        <col width="330">
                        <col>
                        <col width="120">
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">角色名称</th>
                        <th class="text-center">角色备注</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $index => $role)
                        <tr>
                            <td class="text-center">{{ $role->id }}</td>
                            <td>{{ $role->name  }}</td>
                            <td>{{ $role->remarks  }}</td>
                            <td class="text-center">
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-xs btn-primary">编辑</a>
                                <a href="javascript:;" data-url="{{ route('roles.destroy', $role->id) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div id="paginate-render">
                    {{$roles->links('pagination::backend')}}
                </div>
            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
@endsection