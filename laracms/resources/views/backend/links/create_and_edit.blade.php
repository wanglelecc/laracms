@extends('backend::layouts.app')

@section('title', $title = $link->id ? '编辑友情链接' : '添加友情链接' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">友情链接</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $link->id ? route('links.update', $link->id) : route('links.store') }}?redirect={{ previous_url() }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method"  value="{{ $link->id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="" value="{{ old('name',$link->name) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="url" class="col-md-2 col-sm-2 control-label required">链接</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="url" name="url" autocomplete="off" placeholder="" value="{{ old('url',$link->url) }}"
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
                                    <input type="radio" name="target" value="_self" @if(old('target',$link->target) == '_self') checked="" @endif required > 当前窗口
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="target" value="_blank" @if(old('target',$link->target) == '_blank') checked="" @endif required > 新开窗口
                                </label>
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 col-sm-2 ">LOGO</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="panel">
                                <div class="panel-body">
                                    <img src="{{ storage_image_url($link->image) }}" id="image_image" class="img-rounded" width="380px" height="200px" alt="">
                                    <input type="hidden" name="image" id="form_image" value="{{ old('image',$link->image) }}" />
                                    <button id="upload_image" type="button" class="btn btn-info uploader-btn-browse"><i class="icon icon-upload"></i> 上传</button>
                                    <button id="select_thumb" type="button" class="btn btn-primary"><i class="icon icon-file-image"></i> 选择</button>
                                    <button id="delete_thumb" type="button" class="btn btn-danger"><i class="icon icon-remove-sign"></i> 删除</button>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="rating" class="col-md-2 col-sm-2 control-label required">评级</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="number" class="form-control" id="rating" name="rating" autocomplete="off" placeholder="" value="{{ old('rating',$link->rating) }}"
                                   required
                                   data-fv-trigger="blur"
                                   min="0"
                                   max="99"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="rel" class="col-md-2 col-sm-2 control-label required">与网址的关系</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="rel" name="rel" autocomplete="off" placeholder="" value="{{ old('rel',$link->rel) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>


                        <div class="form-group has-feedback  has-icon-right">
                            <label for="order" class="col-md-2 col-sm-2 control-label required">排序</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="number" class="form-control" id="order" name="order" autocomplete="off" placeholder="" value="{{ old('order',$link->order) }}"
                                   required
                                   data-fv-trigger="blur"
                                   min="0"
                                   max="9999"
                            ></div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-2 col-sm-2 control-label">描述</label>
                            <div class="col-md-5 col-sm-10">
                            <textarea class="form-control" rows="6" id="description" name="description"
                                      data-fv-trigger="blur"
                                      minlength="1"
                                      maxlength="255"
                            >{{  old('description', $link->description) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">状态</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" @if($link->status == 0) checked="" @endif required > 隐藏
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" @if($link->status == 1) checked="" @endif required > 显示
                                </label>
                            </div>
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

    @include('backend::common._upload_image_scripts',['elem' => '#upload_image', 'previewElem' => '#image_image', 'fieldElem' => '#form_image', 'folder'=>'link', 'object_id' => $link->id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_image', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_image', 'folder'=>'link', 'object_id' => $link->id ?? 0 ])

@endsection