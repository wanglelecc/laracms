@extends('backend::layouts.app')

@section('title', $title = '微信接入')

@section('navigation')
    <a class="layui-btn layui-btn-normal layui-btn-sm" href="{{ route('wechats.index') }}">微信管理</a>
@endsection

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
                    <div class="alert alert-info">
                        请到微信的公众平台完成接入，以获取appID和appSecret信息。 <a href="https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421135319" target="_blank">帮助</a>
                    </div>


                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2">Token：</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><span class="label">{{$wechat->token}}</span></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2">接入地址：</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><span class="label label-success">{{ route('wechat.api', $wechat->object_id)}}</span></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2"></label>
                            <div class="col-sm-10">
                            @if($wechat->status == 1)
                                <button type="button"  class="btn btn-success">已完成接入</button>
                            @else
                                <button type="button" class="btn btn-danger">未完成接入</button>
                            @endif
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection