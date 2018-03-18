@extends('backend.layouts.app')

@section('title', $title = '基本信息')

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

    <form class="layui-form layui-form-pane" method="POST" action="{{ route('user.update', Auth::User()->id) }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" class="mini-hidden" value="PATCH">

        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{ old('name',$user->name) }}" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="email" name="email" lay-verify="required|email" placeholder="请输入" autocomplete="off" class="layui-input" value="{{ old('email',$user->email) }}" >
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">个人简介</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" name="introduction" lay-verify="required" class="layui-textarea">{{ old('introduction',$user->introduction) }}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            {{--<label class="layui-form-label">头像</label>--}}
            {{--<div class="layui-input-block">--}}
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="avatar">上传头像</button>
                    <input type="hidden" name="avatar" id="form_avatar" value="{{ old('avatar',$user->avatar) }}" />
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" src="{{ $user->getAvatar() }}" id="image_avatar" width="300">
                    </div>
                </div>
            {{--</div>--}}
        </div>

        <div class="layui-form-item">
            {{--<div class="layui-input-block">--}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            {{--</div>--}}
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    layui.use('upload', function(){
        var upload = layui.upload;

        //执行实例
        var uploadInst = upload.render({
            elem: '#avatar' // 绑定元素
            ,url: '{{ route('upload.image') }}?folder=avatar&object_id={{Auth::User()->id}}' // 上传接口
            ,field: 'upload_file'
            ,done: function(res){
                if(res.success == true){
                    $("#form_avatar").val(res.file_uri);
                    $("#image_avatar").attr("src",res.file_path);
                }
                //上传完毕回调
                console.log(res);
            }
            ,error: function(){
                //请求异常回调
                layer.alert('上传失败，请重试!', 2);
            }
        });
    });
</script>
@endsection