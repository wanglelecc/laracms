@extends('backend::layouts.app')

@section('title', $title = '基本信息')

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
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ route('user.update', Auth::User()->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="PATCH">

                        <div class="form-group">
                            <label class="col-md-2 col-sm-2">用户名</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="text" class="form-control" readonly name="name" lay-verify="required" autocomplete="off" value="{{ old('name',$user->name) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-2">邮箱</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="email" name="email" readonly autocomplete="off" class="form-control" value="{{ old('email',$user->email) }}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-2">个人简介</label>
                            <div class="col-md-5 col-sm-10">
                                <textarea class="form-control" rows="4" name="introduction">{{ old('introduction',$user->introduction) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-2">头像</label>
                            <div class="col-md-5 col-sm-10">
                                <div class="panel">
                                    <div class="panel-body">
                                        <img src="{{ $user->getAvatar() }}" id="image_avatar" class="img-rounded" width="200px" height="200px" alt="">
                                        <input type="hidden" name="avatar" id="form_avatar" value="{{ old('avatar',$user->avatar) }}" />
                                        <button id="avatar" type="button" class="btn btn-info uploader-btn-browse"><i class="icon icon-upload"></i> 上传头像</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-2 col-sm-10">
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

@include('backend::common._upload_image_scripts',['elem' => '#avatar', 'previewElem' => '#image_avatar', 'fieldElem' => '#form_avatar', 'folder'=>'avatar', 'object_id' => Auth::User()->id ])

@endsection