@extends('backend.layouts.app')

@section('title', $title = $navigation->id ? '编辑导航' : '添加导航' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">栏目导航</a>
    <a href="">@switch($category)
            @case('desktop')主导航@break
            @case('footer')底部导航@break
            @case('mobile')手机导航@break
        @endswitch</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')

    @php
            $params = is_json($navigation->params) ? json_decode($navigation->params) : new \stdClass();
            $category_id = get_value($params, 'category_id', 0);
            $page_id = get_value($params, 'page_id', 0);

            $navigationHandler = app(\App\Handlers\NavigationHandler::class);
            $navigationItemsByResult = $navigationHandler->getNavigations($category);
            $navigationItems = $navigationHandler->select($navigationItemsByResult);
            $pageItems = $navigationHandler->getPageList();

            $categoryHandler = app(\App\Handlers\CategoryHandler::class);
            $categoryItems = $categoryHandler->select($categoryHandler->getCategorys('article'));
    @endphp

    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form id="formApp" class="layui-form layui-form-pane" method="POST" action="{{ $navigation->id ? route('administrator.navigation.update', [$navigation->id, $category]) : route('administrator.navigation.store', $category) }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="{{ $navigation->id ? 'PUT' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label">父级</label>
                <div class="layui-input-block">
                    <select name="parent">
                        <option value=""></option>
                        <option @if($parent == 0) selected @endif value="0">/</option>
                        @foreach($navigationItems as $key => $value)
                            <option @if($parent == $key) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="layui-form-item" pane="">
                <label class="layui-form-label">类型</label>
                <div class="layui-input-block">
                    <input type="radio" lay-filter="type" required lay-verify="required" name="type" lay-skin="primary" value="action" title="控制器" @if($navigation->type == 'action' || empty($navigation->type)) checked="" @endif >
                    <input type="radio" lay-filter="type" required lay-verify="required" name="type" lay-skin="primary" value="link" title="链接" @if($navigation->type == 'link') checked="" @endif >
                    <input type="radio" lay-filter="type" required lay-verify="required" name="type" lay-skin="primary" value="article" title="文章" @if($navigation->type == 'article') checked="" @endif >
                    <input type="radio" lay-filter="type" required lay-verify="required" name="type" lay-skin="primary" value="page" title="页面" @if($navigation->type == 'page') checked="" @endif >
                    <input type="radio" lay-filter="type" required lay-verify="required" name="type" lay-skin="primary" value="category" title="栏目" @if($navigation->type == 'category') checked="" @endif >
                    <input type="radio" lay-filter="type" required lay-verify="required" name="type" lay-skin="primary" value="navigation" title="导航" @if($navigation->type == 'navigation') checked="" @endif >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">名称</label>
                <div class="layui-input-block">
                    <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="请输入名称" class="layui-input" value="{{ old('title',$navigation->title) }}" >
                </div>
            </div>

            <!--
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea name="description" lay-verify="" placeholder="请输入描述" class="layui-textarea">{{  old('description', $navigation->description) }}</textarea>
                </div>
            </div>
            -->

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">打开方式</label>
                <div class="layui-input-block">
                    <input type="radio" name="target" lay-verify="required" lay-skin="primary" value="_self" title="当前窗口" @if($navigation->target == '_self' || empty($navigation->target)) checked="" @endif >
                    <input type="radio" name="target" lay-verify="required" lay-skin="primary" value="_blank" title="新开窗口" @if($navigation->target == '_blank') checked="" @endif >
                </div>
            </div>

            <div class="layui-form-item params params-action">
                <label class="layui-form-label">路由</label>
                <div class="layui-input-block">
                    <input type="text" name="params[route]" lay-verify="" autocomplete="off" placeholder="请输入路由" class="layui-input" value="{{ get_value($params,'route','') }}" >
                </div>
            </div>

            <div class="layui-form-item params params-action">
                <label class="layui-form-label">参数</label>
                <div class="layui-input-block">
                    <input type="text" name="params[params]" lay-verify="" autocomplete="off" placeholder="请输入关键字" class="layui-input" value="{{ get_value($params,'params','{}') }}" >
                </div>
            </div>

            <div class="layui-form-item params params-category">
                <label class="layui-form-label">分类</label>
                <div class="layui-input-block">
                    <select name="params[category_id]">
                        <option value=""></option>
                        @foreach($categoryItems as $key => $value)
                            <option @if($category_id == $key) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="layui-form-item params params-navigation">
                <label class="layui-form-label">导航</label>
                <div class="layui-input-block">
                    <select name="params[link]">
                        <option value=""></option>
                        @foreach($navigationItemsByResult as $item)
                            <option @if($navigation->link == $item->link) selected @endif value="{{$item->link}}">{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="layui-form-item params params-article">
                <label class="layui-form-label">文章分类</label>
                <div class="layui-input-block">
                    <select name="params[category_id]">
                        <option value=""></option>
                        @foreach($categoryItems as $key => $value)
                            <option @if($category_id == $key) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="layui-form-item params params-page">
                <label class="layui-form-label">页面</label>
                <div class="layui-input-block">
                    <select name="params[page_id]" lay-search="">
                        <option value="">直接选择或搜索选择</option>
                        @foreach($pageItems as $key => $value)
                            <option @if($page_id == $key) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="layui-form-item params params-link">
                <label class="layui-form-label">链接</label>
                <div class="layui-input-block">
                    <input type="text" name="params[link]" lay-verify="" autocomplete="off" placeholder="请输入链接" class="layui-input" value="{{ old('link',$navigation->link) }}" >
                </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="is_show" lay-skin="primary" value="0" title="隐藏" @if($navigation->is_show == '0') checked="" @endif >
                    <input type="radio" name="is_show" lay-skin="primary" value="1" title="显示" @if($navigation->is_show == '1' || empty($navigation->is_show)) checked="" @endif >
                </div>
            </div>

            @if($navigation->id)
            <div class="layui-form-item">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="upload_image">导航图片</button>
                    <input type="hidden" name="image" id="form_image" value="{{ old('image',$navigation->image) }}" />
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" src="{{ $navigation->getImage() }}" id="image_image" style="max-width: 720px;" _height="280">
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                    <input type="number" name="order" lay-verify="" autocomplete="off" placeholder="请输入排序" class="layui-input" value="{{ old('order',$navigation->order) }}" >
                </div>
            </div>
            @endif

            <div class="layui-form-item">
                {{--<div class="layui-input-block">--}}
                <input type="hidden" name="category" value="{{$category}}">
                {{--<input type="hidden" name="parent" value="{{$parent}}">--}}
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
            ,url: '{{ route('upload.image') }}?folder=navigation&object_id={{$navigation->id ?? 0}}' // 上传接口
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

    layui.form.on('radio(type)', function(data){
         showHideForm(data.value);
    });

    function showHideForm(type){
        var paramsNode = $(".params").hide();
        paramsNode.find('input').attr('disabled','disabled');
        paramsNode.find('select').attr('disabled','disabled');

        var paramsTypeNode = $(".params-"+type).show();
        paramsTypeNode.find('input').removeAttr('disabled');
        paramsTypeNode.find('select').removeAttr('disabled');
    }

    @if($navigation->type)
    showHideForm('{{$navigation->type}}');
    @else
    showHideForm('action');
    @endif

    </script>
@stop