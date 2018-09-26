@extends('backend::layouts.app')

@section('title', $title = $role->id ? '编辑角色' : '添加角色' )

@section('breadcrumb')
    <li><a href="javascript:;">系统设置</a></li>
    <li><a href="javascript:;">角色管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">

                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $role->id ? route('roles.update', $role->id) : route('roles.store') }}?redirect={{ previous_url() }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="{{ $role->id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">角色名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="" value="{{ old('name',$role->name) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="64"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="remarks" class="col-md-2 col-sm-2 control-label required">角色备注</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="remarks" name="remarks" autocomplete="off" placeholder="" value="{{ old('remarks',$role->remarks) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="64"
                            ></div>
                        </div>

                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">所属权限</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="checkbox">
                                &nbsp;&nbsp;
                                @foreach($permissions as $key => $val)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="permission[]" value="{{ $val }}" title="{{ $key }}" @if(in_array($val,$rolePermissions) || in_array($val, old('permission',[]))) checked="checked" @endif required > {{$key}}
                                    </label>
                                @endforeach
                            </div></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5 col-sm-10">
                                <button type="submit" class="btn btn-primary">提交</button>
                                <button type="reset" class="btn btn-default">重置</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection