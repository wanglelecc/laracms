@extends('backend::layouts.app')

@section('title', $title = ($slide->id ? '编辑' : '添加') . $slideConfig['name'] )

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">幻灯管理</a></li>
    <li><a href="javascript:;">幻灯片</a></li>
    <li><a href="javascript:;">{{$slideConfig['name']}}管理</a></li>
    <li>{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $slide->id ? route('slides.update', $slide->id) : route('slides.store') }}?redirect={{ previous_url() }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="{{ $slide->id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">标题</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="title" id="title" autocomplete="off" placeholder="" class="form-control" value="{{ old('title',$slide->title) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="100"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="link" class="col-md-2 col-sm-2 control-label required">链接</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="link" name="link" autocomplete="off" placeholder="" value="{{ old('link',$slide->link) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback has-icon-right">
                            <label for="target" class="col-md-2 col-sm-2 control-label required">打开方式</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="target" value="_self" @if(old('target',$slide->target) == '_self') checked="" @endif required > 当前窗口
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="target" value="_blank" @if(old('target',$slide->target) == '_blank') checked="" @endif required > 新开窗口
                                </label>
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-2 col-sm-2 control-label">图片</label>
                            <div class="col-md-8 col-sm-10">
                            <div class="panel">
                                <div class="panel-body">
                                    <img src="{{ storage_image_url($slide->image) }}" id="image_image" class="img-rounded" width="660px" height="300px" alt="">
                                    <input type="hidden" name="image" id="form_image" value="{{ old('image',$slide->image) }}" />
                                    <button id="upload_image" type="button" class="btn btn-info uploader-btn-browse"><i class="icon icon-upload"></i> 上传</button>
                                    <button id="select_thumb" type="button" class="btn btn-primary"><i class="icon icon-file-image"></i> 选择</button>
                                    <button id="delete_thumb" type="button" class="btn btn-danger"><i class="icon icon-remove-sign"></i> 删除</button>
                                </div>
                            </div>
                            </div>
                        </div>

                        @if($slide->id)
                        <div class="form-group has-feedback  has-icon-right">
                            <label for="order" class="col-md-2 col-sm-2 control-label required">排序</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="number" class="form-control" id="order" name="order" autocomplete="off" placeholder="" value="{{ old('order',$slide->order) }}"
                                   required
                                   data-fv-trigger="blur"
                                   min="0"
                                   max="9999"
                            ></div>
                        </div>
                        @endif

                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">状态</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" @if($slide->status == 0) checked="" @endif required > 隐藏
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" @if($slide->status == 1) checked="" @endif required > 显示
                                </label>
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5 col-sm-10">
                                <input type="hidden" name="group" value="{{$group}}" />
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

    @include('backend::common._upload_image_scripts',['elem' => '#upload_image', 'previewElem' => '#image_image', 'fieldElem' => '#form_image', 'folder'=>'slide', 'object_id' => $group->id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_image', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_image', 'folder'=>'slide', 'object_id' => $group->id ?? 0 ])

@endsection