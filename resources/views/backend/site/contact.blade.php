@extends('backend::layouts.app')

@section('title', $title = '联系方式' )

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
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{route('administrator.site.contact')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="POST">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="contacts" class="col-md-2 col-sm-2 control-label ">联系人</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="contacts" name="contacts" autocomplete="off" placeholder="" value="{{ get_value($site, 'contacts') }}"

                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="phone" class="col-md-2 col-sm-2 control-label ">电话</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="phone" name="phone" autocomplete="off" placeholder="" value="{{ get_value($site, 'phone') }}"

                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="fax" class="col-md-2 col-sm-2 control-label ">传真</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="fax" name="fax" autocomplete="off" placeholder="" value="{{ get_value($site, 'fax') }}"

                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="email" class="col-md-2 col-sm-2 control-label">邮箱</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" autocomplete="off" placeholder="" value="{{ get_value($site, 'email') }}"

                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="qq" class="col-md-2 col-sm-2 control-label ">QQ</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="qq" name="qq" autocomplete="off" placeholder="" value="{{ get_value($site, 'qq') }}"

                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="weixin" class="col-md-2 col-sm-2 control-label ">微信</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="weixin" name="weixin" autocomplete="off" placeholder="" value="{{ get_value($site, 'weixin') }}"

                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="weibo" class="col-md-2 col-sm-2 control-label ">微博</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="weibo" name="weibo" autocomplete="off" placeholder="" value="{{ get_value($site, 'weibo') }}"

                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="wangwang" class="col-md-2 col-sm-2 control-label ">旺旺</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="wangwang" name="wangwang" autocomplete="off" placeholder="" value="{{ get_value($site, 'wangwang') }}"

                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="site" class="col-md-2 col-sm-2 control-label ">网址</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="site" name="site" autocomplete="off" placeholder="" value="{{ get_value($site, 'site') }}"

                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="site" class="col-md-2 col-sm-2 control-label">地址</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="address" name="address" autocomplete="off" placeholder="" value="{{ get_value($site, 'address') }}"

                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
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
@endsection