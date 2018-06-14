@extends('backend.layouts.app')

@section('title', $title = '图片管理')

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">媒体管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <a id="upload_image" href="javascript:;" style="margin-left: 15px;" class="layui-btn">上传图片</a>

        <br />
        <br />

        <div class="layui-form">
            @if($images->count())

                <div class="layui-fluid layadmin-cmdlist-fluid">
                    <div class="layui-row layui-col-space30">

                        @foreach($images as $image)
                        <div class="layui-col-md2 layui-col-sm4">
                            <div class="cmdlist-container">
                                <a target="_blank" href="{{$image->getImageUrl()}}">
                                    <img style="width:100%" src="{{$image->getImageUrl()}}">
                                </a>
                                <a href="javascript:;">
                                    <div class="cmdlist-text">
                                        <p class="info">{{$image->title}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach


                        <div class="layui-col-md12 layui-col-sm12">
                            <div id="paginate-render"></div>
                        </div>
                    </div>
                </div>
            @else
                <br />
                <blockquote class="layui-elem-quote">暂无数据!</blockquote>
            @endif

        </div>
    </div>

@endsection

@section('scripts')
    @include('backend.layouts._paginate',[ 'count' => $images->total(), ])

    <script type="">
        layui.use(['upload','form'], function(){
            var form = layui.form;
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#upload_image' // 绑定元素
                ,url: '{{ route('upload.image') }}?folder=website&object_id=0' // 上传接口
                ,field: 'upload_file'
                ,done: function(res){
                    if(res.success == true){
                        window.location.href="{{route('media.image')}}";
                    }
                    //上传完毕回调
                    console.log(res);
                }
                ,error: function(){
                    //请求异常回调
                    layer.alert('上传失败，请重试!', 2);
                }
            });

            form.render();
        });



    </script>
@endsection