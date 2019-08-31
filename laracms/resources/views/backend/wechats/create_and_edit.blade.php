@extends('backend::layouts.app')

@section('title', $title = $wechat->id ? '编辑公众号' : '添加公众号' )

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li><a href="javascript:;">微信管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">

                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $wechat->id ? route('wechats.update', $wechat->id) : route('wechats.store') }}?redirect={{ previous_url() }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="{{ $wechat->id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">状态</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="type" value="subscribe" @if(old('type', $wechat->type) == 'subscribe') checked="" @endif required > 订阅号
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" value="service"  @if(old('type',$wechat->type) == 'service') checked="" @endif required > 服务号
                                </label>
                            </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">公众号名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="" value="{{ old('name',$wechat->name) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="64"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="account" class="col-md-2 col-sm-2 control-label required">原始ID</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="account" name="account" autocomplete="off" placeholder="" value="{{ old('account',$wechat->account) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="30"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="app_id" class="col-md-2 col-sm-2 control-label required">appID</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="app_id" name="app_id" autocomplete="off" placeholder="" value="{{ old('app_id',$wechat->app_id) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="30"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="app_secret" class="col-md-2 col-sm-2 control-label required">appSecret</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="app_secret" name="app_secret" autocomplete="off" placeholder="" value="{{ old('app_secret',$wechat->app_secret) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="32"
                            ></div>
                        </div>

                        @if($wechat->id)
                        <div class="form-group has-feedback  has-icon-right">
                            <label for="token" class="col-md-2 col-sm-2 control-label required">Token</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="token" name="token" autocomplete="off" placeholder="" value="{{ old('token',$wechat->token) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="url" class="col-md-2 col-sm-2 control-label required">Url</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="url" name="url" autocomplete="off" placeholder="" disabled value="{{ old('url',$wechat->url) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="qrcode" class="col-md-2 col-sm-2 control-label required">二维码Code</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="qrcode" name="qrcode" autocomplete="off" placeholder="" value="{{ old('qrcode',$wechat->qrcode) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>
                        @endif

                        <div class="form-group has-feedback has-icon-right">
                            <label for="certified" class="col-md-2 col-sm-2 control-label required">状态</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="certified" value="0" @if(old('certified', $wechat->certified) == '0') checked="" @endif required > 未认证
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="certified" value="1"  @if(old('certified',$wechat->certified) == '1') checked="" @endif required > 已认证
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
@endsection