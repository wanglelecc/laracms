@extends('backend.layouts.app')

@section('title', $title = '微信接入')

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">微信管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')

<div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <blockquote class="layui-elem-quote layui-text">
            请到微信的公众平台完成接入，以获取appID和appSecret信息。 <a href="https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421135319" target="_blank">帮助</a>
        </blockquote>

        <div class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">Token：</label>
                <div class="layui-input-block">
                    <p style="padding-top:10px;"><span class="layui-badge layui-bg-green">{{$wechat->token}}</span></p>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">接入地址：</label>
                <div class="layui-input-block">
                    <p style="padding-top:10px;"><span class="layui-badge layui-bg-cyan">{{ route('wechat.api', $wechat->object_id)}}</span></p>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">&nbsp;</label>
                <div class="layui-input-block">
                    <div class="layui-btn-group demoTest" style="margin-top: 5px;">
                        @if($wechat->status == 1)
                        <button class="layui-btn layui-btn-normal">已完成接入</button>
                        @else
                        <button class="layui-btn layui-btn-danger">未完成接入</button>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection