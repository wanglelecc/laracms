@extends('backend.layouts.app')

@section('title', $title = $wechat->id ? '编辑公众号' : '添加公众号' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">微信管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')

<div class="layui-main">

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
    </fieldset>


    <form class="layui-form layui-form-pane" method="POST" action="{{ $wechat->id ? route('wechats.update', $wechat->id) : route('wechats.store') }}?redirect={{ previous_url() }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="{{ $wechat->id ? 'PATCH' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label" for="type-field">公共号类型</label>
                <div class="layui-input-block">
                    <select name="type" lay-verify="required">
                        <option value=""></option>
                        <option @if($wechat->type == 'subscribe') selected @endif value="subscribe">订阅号</option>
                        <option @if($wechat->type == 'service') selected @endif value="service">服务号</option>
                    </select>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" for="name-field">公众号名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" id="name-field" lay-verify="required" autocomplete="off" placeholder="请输入公众号名称" class="layui-input" value="{{ old('name',$wechat->name) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" for="account-field">原始ID</label>
                <div class="layui-input-block">
                    <input type="text" name="account" id="account-field" lay-verify="required" autocomplete="off" placeholder="请输入原始ID" class="layui-input" value="{{ old('account',$wechat->account) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" for="app_id-field">appID</label>
                <div class="layui-input-block">
                    <input type="text" name="app_id" id="app_id-field" lay-verify="required" autocomplete="off" placeholder="请输入appID" class="layui-input" value="{{ old('app_id',$wechat->app_id) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" for="app_secret-field">appSecret</label>
                <div class="layui-input-block">
                    <input type="text" name="app_secret" id="app_secret-field" lay-verify="required" autocomplete="off" placeholder="请输入appSecret" class="layui-input" value="{{ old('app_secret',$wechat->app_secret) }}" >
                </div>
            </div>

            @if($wechat->id)
            <div class="layui-form-item">
                <label class="layui-form-label" for="token-field">Token</label>
                <div class="layui-input-block">
                    <input type="text" name="token" id="token-field" lay-verify="" autocomplete="off" placeholder="请输入Token" class="layui-input" value="{{ old('token',$wechat->token) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" for="url-field">Url</label>
                <div class="layui-input-block">
                    <input type="text" name="url" id="url-field" disabled lay-verify="" autocomplete="off" placeholder="请输入Url" class="layui-input" value="{{ old('url',$wechat->url) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" for="qrcode-field">微信二维码</label>
                <div class="layui-input-block">
                    <input type="text" name="qrcode" id="qrcode-field" disabled lay-verify="" autocomplete="off" placeholder="请输入Qrcode" class="layui-input" value="{{ old('qrcode',$wechat->qrcode) }}" >
                </div>
            </div>
            @endif

            <div class="layui-form-item">
                <label class="layui-form-label" for="certified-field">认证类型</label>
                <div class="layui-input-block">
                    <select name="certified" lay-verify="required">
                        <option value=""></option>
                        <option @if($wechat->certified == '0') selected @endif value="0">未认证</option>
                        <option @if($wechat->certified == '1') selected @endif value="1">已认证</option>
                    </select>
                </div>
            </div>

            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
    </form>

</div>

@endsection

@section('scripts')
@endsection