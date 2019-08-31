@extends('backend::layouts.app')

@section('title', $title = $permission->id ? '编辑权限' : '添加权限' )

@section('breadcrumb')
    <li><a href="javascript:;">系统设置</a></li>
    <li><a href="javascript:;">权限管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">

                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $permission->id ? route('permissions.update', $permission->id) : route('permissions.store') }}?redirect={{ previous_url() }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $permission->id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="parent" class="col-md-2 col-sm-2 control-label required">父级</label>
                            <div class="col-md-5 col-sm-10">
                                <select data-placeholder="请选择父级" class="chosen-select form-control"  tabindex="2" name="parent">
                                    <option value=""></option>
                                    <option @if($parent == 0) selected @endif value="0">/</option>
                                    @foreach($permissions as $key => $value)
                                        <option @if($parent == $key) selected @endif value="{{$key}}">/ {{$value}}</option>
                                    @endforeach
                                </select></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">权限名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="" value="{{ old('name',$permission->name) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="64"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="remarks" class="col-md-2 col-sm-2 control-label required">权限备注</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="remarks" name="remarks" autocomplete="off" placeholder="" value="{{ old('remarks',$permission->remarks) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="64"
                            ></div>
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