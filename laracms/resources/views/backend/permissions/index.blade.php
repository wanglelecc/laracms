@extends('backend::layouts.app')

@section('title', $title = '权限列表')

@section('breadcrumb')
    <li><a href="javascript:;">系统设置</a></li>
    <li><a href="javascript:;">权限管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
    @php

    @endphp
    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">

            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                </div>
                <div class="tools-group">
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                    <button class="btn btn-danger" form="form-permissions-list"><i class="icon icon-sort-by-order-alt"></i> 排序</button>
                </div>
            </div>
            @if(count($permissions))
                <form name="form-permissions-list" id="form-permissions-list" class="" method="POST" action="{{route('permissions.order')}}">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <table class="table table-bordered">
                        <colgroup>
                            <col width="50">
                            <col width="85">
                            <col width="330">
                            <col>
                            <col width="170">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">排序</th>
                            <th class="text-center">权限名称</th>
                            <th class="text-center">权限备注</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $index => $permission)
                            <tr>
                                <td class="text-center">{{ $permission->id }}</td>
                                <td class="text-center">
                                    <input type="hidden" name="id[]" value="{{$permission->id}}">
                                    <input type="tel" name="order[]" autocomplete="off" class="form-control text-center" value="{{ $permission->order  }}">
                                </td>
                                <td>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$permission->lavel) !!}@if($permission->lavel > 0)├─ @endif{{ $permission->name  }}</td>
                                <td>{{ $permission->remarks  }}</td>
                                <td class="text-center">
                                    <a href="{{ route('permissions.create') }}?parent={{$permission->id}}" class="btn btn-xs btn-success">添加</a>
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-xs btn-primary">编辑</a>
                                    <a href="javascript:;" data-url="{{ route('permissions.destroy', $permission->id) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
@endsection