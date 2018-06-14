@extends('backend.layouts.app')

@section('title', $title = $article->id ? '编辑' : '添加' )

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    @php
        $object_id = $article->object_id ?? create_object_id();
        $type = $article->type ?? request('type','article');
    @endphp
    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" method="POST" action="{{ $article->id ? route('articles.update', $article->id) : route('articles.store') }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method"  value="{{ $article->id ? 'PATCH' : 'POST' }}">
            <input type="hidden" name="type" value="{{ $type }}">


            <div class="layui-form-item">
                <label class="layui-form-label">所属分类</label>
                <div class="layui-input-block">
                    <div><template v-for="item in category_id">
                            <template v-if="item.check === true">
                                <input type="hidden" name="category_id[]" checked="" v-bind:value="item.id"  v-bind:title="item.name" />&nbsp;&nbsp;
                                <button type="button" class="layui-btn layui-btn-normal">@{{item.name}}&nbsp;&nbsp;<i v-on:click="remove(item.id)" class="layui-icon"></i></button>
                            </template>

                        </template>
                        <button type="button" class="layui-btn" v-on:click="dialog_category = !dialog_category"><i class="layui-icon">+</i>选择分类</button>
                    </div>

                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{ old('title',$article->title) }}" >
                </div>
            </div>

            @if($article->id)
            <div class="layui-form-item">
                <label class="layui-form-label">副标题</label>
                <div class="layui-input-block">
                    <input type="text" name="subtitle" lay-verify="" autocomplete="off" placeholder="请输入副标题" class="layui-input" value="{{ old('subtitle',$article->subtitle) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">关键词</label>
                <div class="layui-input-block">
                    <input type="text" name="keywords" lay-verify="" autocomplete="off" placeholder="请输入关键词" class="layui-input" value="{{ old('keywords',$article->keywords) }}" >
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea name="description" lay-verify="" placeholder="描述" class="layui-textarea">{{  old('description', $article->description) }}</textarea>
                </div>
            </div>
            @endif

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">内容</label>
                <div class="layui-input-block">
                    <textarea name="content" lay-verify="" id="content" placeholder="内容" class="layui-textarea editor">{{  old('content', $article->content) }}</textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">作者</label>
                <div class="layui-input-block">
                    <input type="text" name="author" lay-verify="" autocomplete="off" placeholder="请输入作者" class="layui-input" value="{{ old('author', $article->author) }}" >
                </div>
            </div>

            @if($type)
                @includeIf('backend.article.template.'.$type,['article' => $article])
            @endif


        @if($article->id)

            <div class="layui-form-item">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="upload_thumb">预览图</button>
                    <input type="hidden" name="thumb" id="form_thumb" value="{{ old('image',$article->thumb) }}" />
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" src="{{ $article->getThumb() }}" id="image_image" style="max-width: 520px;" _height="280">
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                    <input type="number" name="order" lay-verify="required" autocomplete="off" placeholder="请输入排序" class="layui-input" value="{{ old('order',$article->order) }}" >
                </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">链接类型</label>
                <div class="layui-input-block">
                    <input type="radio" name="is_link" lay-skin="primary" value="0" title="内链" @if($article->is_link == '0') checked="" @endif >
                    <input type="radio" name="is_link" lay-skin="primary" value="1" title="外链" @if($article->is_link == '1') checked="" @endif >
                </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">跳转链接</label>
                <div class="layui-input-block">
                    <input type="text" name="link" lay-verify="" autocomplete="off" placeholder="文章跳转链接" class="layui-input" value="{{ old('link',$article->link) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">模板</label>
                <div class="layui-input-block">
                    <input type="text" name="template" lay-verify="" autocomplete="off" placeholder="请输入模板" class="layui-input" value="{{ old('template',$article->template) }}" >
                </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" lay-skin="primary" value="0" title="隐藏" @if($article->status == '0') checked="" @endif >
                    <input type="radio" name="status" lay-skin="primary" value="1" title="显示" @if($article->status == '1') checked="" @endif >
                </div>
            </div>
            @endif

            <div class="layui-form-item">
                {{--<div class="layui-input-block">--}}
                <input type="hidden" name="object_id" value="{{ $object_id }}" />
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                {{--</div>--}}
            </div>
        </form>
    </div>


    <div v-show="dialog_category" class="layui-layer layui-layer-dialog" id="layui-category" type="dialog" style="display:none; z-index: 19891093; width: 300px; top:300px; left: 50%; margin-left:-150px; margin-top:-100px;">
        <div class="layui-layer-title" style="cursor: move;">选择分类</div>
        <div class="layui-layer-content">
            <ul v-for="item in category_id">
                <li>
                    <label><input type="checkbox" v-model="item.check" v-bind:value="item.id" v-bind:title="item.name" /> @{{repeat('|--',item.lavel)}}@{{item.name}}</label>
                </li>
            </ul>
        </div>
        <div class="layui-layer-btn layui-layer-btn-">
            <a class="layui-layer-btn0"  v-on:click="dialog_category = !dialog_category">确认</a>
        </div>
    </div>
@endsection

@section('styles')
    @include('backend.common._editor_styles')
@stop

@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    <script type="">
        var app = new Vue({
            el: '#app',
            data : {
                dialog_category : false,
                category_id : <?php echo json_encode($category); ?>
            },

            methods:{
                remove : function(id){
                    var category_id = this.category_id;
                    // console.log(id);
                    var index = _.findIndex(category_id,{'id':id});
                    category_id[index]['check'] = false;
                    this.category_id = category_id;
                    // this.category_id = category_id.splice(index,1);
                    // console.log(index);
                    // console.log(tmp);
                },

                repeat : function(str , n){
                    return new Array(n+1).join(str);
                }
            }
        });

        layui.use(['upload','form'], function(){
            var form = layui.form;
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#upload_thumb' // 绑定元素
                ,url: '{{ route('upload.image') }}?folder=article&object_id={{$article->id ?? 0}}' // 上传接口
                ,field: 'upload_file'
                ,done: function(res){
                    if(res.success == true){
                        $("#form_thumb").val(res.file_uri);
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

            form.render();
        });



    </script>

    @include('backend.common._editor_scripts',['folder'=>'article', 'object_id'=>$object_id])
@stop