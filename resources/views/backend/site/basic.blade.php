@extends('backend::layouts.app')

@section('title', $title = '站点信息' )

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{route('administrator.site.basic')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="POST">

                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">站点状态</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" @if(get_value($site, 'status', 0) == 0) checked="" @endif required > 开启
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" @if(get_value($site, 'status', 1) == 1) checked="" @endif required > 关闭
                                </label>
                            </div></div>
                        </div>

                        <div class="form-group">
                            <label for="close_tips" class="col-md-2 col-sm-2 control-label required">关闭提示</label>
                            <div class="col-md-5 col-sm-10">
                            <textarea class="form-control" name="close_tips" rows="4"
                                      required
                                      data-fv-trigger="blur"
                                      minlength="1"
                            >{{ get_value($site, 'close_tips') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">网站名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="" value="{{ get_value($site, 'name') }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="64"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="create_year" class="col-md-2 col-sm-2 control-label required">创建年份</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="create_year" name="create_year" autocomplete="off" placeholder="" value="{{  get_value($site, 'create_year') }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="4"
                                   maxlength="4"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="copyright" class="col-md-2 col-sm-2 control-label required">版权</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="copyright" name="copyright" autocomplete="off" placeholder="" value="{{  get_value($site, 'copyright') }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="64"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="keywords" class="col-md-2 col-sm-2 control-label required">关键词</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="keywords" name="keywords" autocomplete="off" placeholder="" value="{{  get_value($site, 'keywords') }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="index_keywords" class="col-md-2 col-sm-2 control-label required">首页关键词</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="index_keywords" name="index_keywords" autocomplete="off" placeholder="" value="{{  get_value($site, 'index_keywords') }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="slogan" class="col-md-2 col-sm-2 control-label">站点口号</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="slogan" name="slogan" autocomplete="off" placeholder="" value="{{  get_value($site, 'slogan') }}"
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="icp" class="col-md-2 col-sm-2 control-label">备案号</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="icp" name="icp" autocomplete="off" placeholder="" value="{{  get_value($site, 'icp') }}"
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="64"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="icp_link" class="col-md-2 col-sm-2 control-label">备案链接</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="icp_link" name="icp_link" autocomplete="off" placeholder="" value="{{  get_value($site, 'icp_link') }}"
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="255"
                            ></div>
                        </div>



                        <div class="form-group">
                            <label for="description" class="col-md-2 col-sm-2 control-label">站点描述</label>
                            <div class="col-md-5 col-sm-10">
                            <textarea class="form-control" rows="6" id="description" name="description"
                                      data-fv-trigger="blur"
                                      minlength="1"
                            >{{ get_value($site, 'description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="meta" class="col-md-2 col-sm-2 control-label">Meta 标签</label>
                            <div class="col-md-8 col-sm-10">
                            <textarea class="form-control codeeditor" mode="html" rows="10" id="meta" name="meta"
                                      data-fv-trigger="blur"
                                      minlength="1"
                            >{{ get_value($site, 'meta') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="statistics" class="col-md-2 col-sm-2 control-label">统计代码</label>
                            <div class="col-md-8 col-sm-10">
                            <textarea class="form-control codeeditor" mode="javascript" rows="15" id="statistics" name="statistics"
                                      data-fv-trigger="blur"
                                      minlength="1"
                            >{{ get_value($site, 'statistics') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="map" class="col-md-2 col-sm-2 control-label">站点地图</label>
                            <div class="col-md-8 col-sm-10">
                            <textarea class="form-control editor" rows="6" id="map" name="map"
                                      data-fv-trigger="blur"
                                      minlength="1"
                            >{{ get_value($site, 'map') }}</textarea>
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

@section('styles')
    @include('backend::common._editor_styles')
    @include('backend::common._code_editor_styles')
@stop

@section('scripts')
    @include('backend::common._editor_scripts',['folder'=>'company'])
    @include('backend::common._code_editor_scripts',['folder'=>'company'])
@stop