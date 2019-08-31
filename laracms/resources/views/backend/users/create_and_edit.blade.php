@extends('backend::layouts.app')

@section('title', $title = $user->id ? '编辑用户' : '添加用户' )

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

                    <form id="form-validator" method="POST" class="form-horizontal" action="{{ $user->id ? route('users.update', $user->id) : route('users.store') }}?redirect={{ previous_url() }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $user->id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">用户名</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="" value="{{ old('name',$user->name) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="3"
                                   maxlength="16"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">邮箱</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="" value="{{ old('email',$user->email) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="6"
                                   maxlength="32"
                            ></div>
                        </div>

                        @if(!$user->id)
                            <div class="form-group has-feedback  has-icon-right">
                                <label for="password" class="col-md-2 col-sm-2 control-label required">密码</label>
                                <div class="col-md-5 col-sm-10">
                                <input type="password" class="form-control" id="password" name="old_password" autocomplete="off" value="{{ old('old_password') }}"
                                       required
                                       data-fv-trigger="blur"
                                       minlength="6"
                                       maxlength="16"
                                ></div>
                            </div>
                        @endif

                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">角色</label>
                            <div class="col-md-5 col-sm-10">
                                <div class="checkbox">
                                    @foreach($roles as $key => $val)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="roles[]" value="{{ $val }}" title="{{ $key }}" @if(in_array($val,$userRoles) || in_array($val, old('roles',[]))) checked="checked" @endif required > {{$key}}
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">角色</label>
                            <div class="col-md-5 col-sm-10">
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" @if(old('status',$user->status) == 0) checked="checked" @endif required > 未激活
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" @if(old('status',$user->status) == 1) checked="checked" @endif required > 正常
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="2" @if(old('status',$user->status) == 2) checked="checked" @endif required > 停用
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 col-sm-2 control-label">个人简介</label>
                            <div class="col-md-5 col-sm-10">
                                <textarea class="form-control" name="introduction">{{ old('introduction',$user->introduction) }}</textarea>
                            </div>
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