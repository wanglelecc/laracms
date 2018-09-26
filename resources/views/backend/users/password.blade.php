@extends('backend::layouts.app')

@section('title', $title = '重置密码')

@section('breadcrumb')
    <li><a href="javascript:;">系统设置</a></li>
    <li><a href="javascript:;">用户管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">

                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ route('administrator.users.password.update', $user->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label for="password" class="col-md-2 col-sm-2 control-label required">新密码</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="请输入新密码" value="{{ old('password') }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="6"
                                   maxlength="16"
                            ></div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-2 col-sm-2 control-label required">确认密码</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="off" placeholder="请输入确认密码" value="{{ old('password_confirmation') }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="6"
                                   maxlength="16"
                                   data-fv-identical="true"
                                   data-fv-identical-field="password"
                                   data-fv-identical-message="两次输入不一致"
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
