@extends('backend::layouts.app')

@section('title', $title = $navigation->id ? '编辑导航' : '添加导航' )

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li><a href="javascript:;">栏目导航</a></li>
    <li><a href="javascript:;">@switch($category)
            @case('desktop')主导航@break
            @case('footer')底部导航@break
            @case('mobile')手机导航@break
        @endswitch</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

    @php
            $params = is_json($navigation->params) ? json_decode($navigation->params) : new \stdClass();
            $category_id = get_value($params, 'category_id', 0);
            $page_id = get_value($params, 'page_id', 0);

            $navigationHandler = app(\Wanglelecc\Laracms\Handlers\NavigationHandler::class);
            $navigationItemsByResult = $navigationHandler->getNavigations($category);
            $navigationItems = $navigationHandler->select($navigationItemsByResult);
            $pageItems = $navigationHandler->getPageList();

            $categoryHandler = app(\Wanglelecc\Laracms\Handlers\CategoryHandler::class);
            $categoryItems = $categoryHandler->select($categoryHandler->getCategorys('article'));
    @endphp


    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST"action="{{ $navigation->id ? route('administrator.navigation.update', [$navigation->id, $category]) : route('administrator.navigation.store', $category) }}?redirect={{ previous_url() }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="{{ $navigation->id ? 'PUT' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="parent" class="col-md-2 col-sm-2 control-label required">父级</label>
                            <div class="col-md-5 col-sm-10">
                            <select data-placeholder="请选择父级菜单" class="chosen-select form-control"  tabindex="2" name="parent">
                                <option value=""></option>
                                <option @if($parent == 0) selected @endif value="0">/</option>
                                @foreach($navigationItems as $key => $value)
                                    <option @if($parent == $key) selected @endif value="{{$key}}">/ {{$value}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-icon-right">
                            <label for="target" class="col-md-2 col-sm-2 control-label required">类型</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="type" value="action" v-model="type" required > 控制器
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" value="link" v-model="type" required > 链接
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" value="article" v-model="type" required > 文章
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" value="page" v-model="type" required > 页面
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" value="category" v-model="type" required > 栏目
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" value="navigation" v-model="type" required > 导航
                                </label>
                            </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" autocomplete="off" placeholder="" value="{{ old('title',$navigation->title) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="100"
                            ></div>
                        </div>

                        <div class="form-group has-feedback has-icon-right">
                            <label for="target" class="col-md-2 col-sm-2 control-label required">打开方式</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="target" value="_self" @if(old('target',$navigation->target) == '_self') checked="" @endif required > 当前窗口
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="target" value="_blank" @if(old('target',$navigation->target) == '_blank') checked="" @endif required > 新开窗口
                                </label>
                            </div>
                            </div>
                        </div>

                        <div v-if="type == 'action'" class="form-group has-feedback  has-icon-right">
                            <label for="params[route]" class="col-md-2 col-sm-2 control-label required">路由</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="params[route]" name="params[route]" autocomplete="off" placeholder="" value="{{ get_value($params,'route','') }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            >
                            </div>
                        </div>

                        <div v-if="type == 'action'" class="form-group has-feedback  has-icon-right">
                            <label for="params[route]" class="col-md-2 col-sm-2 control-label required">参数</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="params[params]" name="params[params]" autocomplete="off" placeholder="" value="{{ get_value($params,'params','') }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            >
                            </div>
                        </div>

                        <div  v-if="type == 'article' || type == 'category' " class="form-group has-feedback  has-icon-right">
                            <label for="parent" class="col-md-2 col-sm-2 control-label required">分类</label>
                            <div class="col-md-5 col-sm-10">
                            <select class="form-control" name="params[category_id]">
                                <option value="">/ </option>
                                @foreach($categoryItems as $key => $value)
                                    <option @if($category_id == $key) selected @endif value="{{$key}}">/ {{$value}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div v-if="type == 'navigation'" class="form-group has-feedback  has-icon-right">
                            <label for="parent" class="col-md-2 col-sm-2 control-label required">导航</label>
                            <div class="col-md-5 col-sm-10">
                            <select class="form-control" name="params[link]">
                                <option value=""></option>
                                @foreach($navigationItemsByResult as $item)
                                    <option @if($navigation->link == $item->link) selected @endif value="{{$item->link}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div v-if="type == 'page'" class="form-group has-feedback  has-icon-right">
                            <label for="parent" class="col-md-2 col-sm-2 control-label required">页面</label>
                            <div class="col-md-5 col-sm-10">
                            <select class="form-control" name="params[page_id]">
                                <option value="">请选择</option>
                                @foreach($pageItems as $key => $value)
                                    <option @if($page_id == $key) selected @endif value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div v-if="type == 'link'" class="form-group has-feedback  has-icon-right">
                            <label for="params[route]" class="col-md-2 col-sm-2 control-label required">链接</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="params[link]" name="params[link]" autocomplete="off" placeholder="" value="{{ get_value($params,'link','') }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 col-sm-2 ">导航图片</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="panel">
                                <div class="panel-body">
                                    <img src="{{ storage_image_url($navigation->image) }}" id="image_image" class="img-rounded" width="250px" height="200px" alt="">
                                    <input type="hidden" name="image" id="form_image" value="{{ old('image',$navigation->image) }}" />
                                    <button id="upload_image" type="button" class="btn btn-info uploader-btn-browse"><i class="icon icon-upload"></i> 上传</button>
                                    <button id="select_thumb" type="button" class="btn btn-primary"><i class="icon icon-file-image"></i> 选择</button>
                                    <button id="delete_thumb" type="button" class="btn btn-danger"><i class="icon icon-remove-sign"></i> 删除</button>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">状态</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="is_show" value="0" @if($navigation->is_show == 0) checked="" @endif required > 隐藏
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="is_show" value="1"  @if($navigation->is_show == '1' || empty($navigation->is_show)) checked="" @endif required > 显示
                                </label>
                            </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5 col-sm-10">
                                <input type="hidden" name="category" value="{{$category}}">
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
    <script type="text/javascript">

       var app = new Vue({
           el : '#app',
           data : {
               type : "{{old('type',$navigation->type)}}"
           },

           updated : function(){

           },

           watch : {
               type : function(newValue, oldValue){
                    // console.log(newValue, oldValue);

               }
           }
       });

    </script>

    @include('backend::common._upload_image_scripts',['elem' => '#upload_image', 'previewElem' => '#image_image', 'fieldElem' => '#form_image', 'folder'=>'navigation', 'object_id' => $navigation->id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_image', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_image', 'folder'=>'navigation', 'object_id' => $navigation->id ?? 0 ])

@stop