@extends('backend.layouts.app')

@section('title', $title = ($slide->id ? '编辑' : '添加') . $slideConfig['name'] )

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">幻灯管理</a>
    <a href="">幻灯片</a>
    <a href="">{{$slideConfig['name']}}管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <a href="{{ route('slides.manage', $group) }}" class="layui-btn layui-btn-primary">返回{{$slideConfig['name']}}</a>
        <br /><br />

        <form class="layui-form layui-form-pane" method="POST" action="{{ $slide->id ? route('slides.update', $slide->id) : route('slides.store') }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="{{ $slide->id ? 'PATCH' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{ old('title', $slide->title) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">链接</label>
                <div class="layui-input-block">
                    <input type="url" name="link" lay-verify="required" autocomplete="off" placeholder="请输入链接" class="layui-input" value="{{ old('link', $slide->link) }}" >
                </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">打开方式</label>
                <div class="layui-input-block">
                    <input type="radio" name="target" lay-verify="required" lay-skin="primary" value="_self" title="当前窗口" @if($slide->target == '_self') checked="" @endif >
                    <input type="radio" name="target" lay-verify="required" lay-skin="primary" value="_blank" title="新开窗口" @if($slide->target == '_blank') checked="" @endif >
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="upload_image">图片</button>
                    <input type="hidden" name="image" id="form_image" value="{{ old('image',$slide->image) }}" />
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" src="{{ $slide->getImage() }}" id="image_image" style="max-width: 520px;" _height="280">
                    </div>
                </div>
            </div>

            @if($slide->id)
            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                    <input type="number" name="order" lay-verify="required" autocomplete="off" placeholder="请输入排序" class="layui-input" value="{{ old('order',$slide->order) }}" >
                </div>
            </div>

            {{--<div class="layui-form-item layui-form-text">--}}
                {{--<label class="layui-form-label">描述</label>--}}
                {{--<div class="layui-input-block">--}}
                    {{--<textarea name="description" lay-verify="" placeholder="描述" class="layui-textarea">{{  old('description', $slide->description) }}</textarea>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" lay-skin="primary" value="0" title="隐藏" @if($slide->status == '0') checked="" @endif >
                    <input type="radio" name="status" lay-skin="primary" value="1" title="显示" @if($slide->status == '1') checked="" @endif >
                </div>
            </div>
            @endif

            <div class="layui-form-item">
                {{--<div class="layui-input-block">--}}
                <input type="hidden" name="group" value="{{$group}}" />
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
                elem: '#upload_image' // 绑定元素
                ,url: '{{ route('upload.image') }}?folder=slide&object_id={{$group ?? 0}}' // 上传接口
                ,field: 'upload_file'
                ,done: function(res){
                    if(res.success == true){
                        $("#form_image").val(res.file_uri);
                        $("#image_image").attr("src",res.file_path);
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