@extends('backend.layouts.app')

@section('title', $title = $link->id ? '编辑友情链接' : '添加友情链接' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">友情链接</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" method="POST" action="{{ $link->id ? route('links.update', $link->id) : route('links.store') }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="{{ $link->id ? 'PATCH' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label">名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入名称" class="layui-input" value="{{ old('name',$link->name) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">链接</label>
                <div class="layui-input-block">
                    <input type="url" name="url" lay-verify="required" autocomplete="off" placeholder="请输入链接" class="layui-input" value="{{ old('url',$link->url) }}" >
                </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">打开方式</label>
                <div class="layui-input-block">
                    <input type="radio" name="target" lay-verify="required" lay-skin="primary" value="_self" title="当前窗口" @if($link->target == '_self') checked="" @endif >
                    <input type="radio" name="target" lay-verify="required" lay-skin="primary" value="_blank" title="新开窗口" @if($link->target == '_blank') checked="" @endif >
                </div>
            </div>

            @if($link->id)
            <div class="layui-form-item">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="upload_image">图片</button>
                    <input type="hidden" name="image" id="form_image" value="{{ old('image',$link->image) }}" />
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" src="{{ $link->getImage() }}" id="image_image" style="max-width: 720px;" _height="280">
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">评级</label>
                <div class="layui-input-block">
                    <input type="number" name="rating" lay-verify="required" autocomplete="off" placeholder="请输入评级" class="layui-input" value="{{ old('rating',$link->rating) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">与网站关系</label>
                <div class="layui-input-block">
                    <input type="text" name="rel" lay-verify="" autocomplete="off" placeholder="与网站关系" class="layui-input" value="{{ old('rel',$link->rel) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                    <input type="number" name="order" lay-verify="required" autocomplete="off" placeholder="请输入排序" class="layui-input" value="{{ old('order',$link->order) }}" >
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea name="description" lay-verify="" placeholder="描述" class="layui-textarea">{{  old('description', $link->description) }}</textarea>
                </div>
            </div>


            <div class="layui-form-item" pane="">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" lay-skin="primary" value="0" title="隐藏" @if($link->status == '0') checked="" @endif >
                    <input type="radio" name="status" lay-skin="primary" value="1" title="显示" @if($link->status == '1') checked="" @endif >
                </div>
            </div>

            @endif

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
    <script type="text/javascript">
        layui.use('upload', function(){
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#upload_image' // 绑定元素
                ,url: '{{ route('upload.image') }}?folder=link&object_id={{$link->id ?? 0}}' // 上传接口
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