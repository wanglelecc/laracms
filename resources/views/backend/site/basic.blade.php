@extends('backend.layouts.app')

@section('title', $title = '站点信息' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" method="POST" action="{{route('administrator.site.basic')}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="POST">

            <div class="layui-form-item">
                <label class="layui-form-label">网站名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="" autocomplete="off" placeholder="网站名称" class="layui-input" value="{{ get_value($site, 'name') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">创建年份</label>
                <div class="layui-input-block">
                    <input type="text" name="create_year" lay-verify="" autocomplete="off" placeholder="创建年份" class="layui-input" value="{{  get_value($site, 'create_year') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">版权</label>
                <div class="layui-input-block">
                    <input type="text" name="copyright" lay-verify="" autocomplete="off" placeholder="版权" class="layui-input" value="{{  get_value($site, 'copyright') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">关键词</label>
                <div class="layui-input-block">
                    <input type="text" name="keywords" lay-verify="" autocomplete="off" placeholder="关键词" class="layui-input" value="{{  get_value($site, 'keywords') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">首页关键词</label>
                <div class="layui-input-block">
                    <input type="text" name="index_keywords" lay-verify="" autocomplete="off" placeholder="首页关键词" class="layui-input" value="{{  get_value($site, 'index_keywords') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">站点口号</label>
                <div class="layui-input-block">
                    <input type="text" name="slogan" lay-verify="" autocomplete="off" placeholder="站点口号" class="layui-input" value="{{  get_value($site, 'slogan') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">备案号</label>
                <div class="layui-input-block">
                    <input type="text" name="icp" lay-verify="" autocomplete="off" placeholder="ICP备案号" class="layui-input" value="{{  get_value($site, 'icp') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">备案链接</label>
                <div class="layui-input-block">
                    <input type="text" name="icp_link" lay-verify="" autocomplete="off" placeholder="ICP备案链接" class="layui-input" value="{{  get_value($site, 'icp_link') }}" >
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">Meta 标签</label>
                <div class="layui-input-block">
                    <textarea name="meta" lay-verify="" placeholder="Meta 标签" class="layui-textarea">{{  get_value($site, 'meta') }}</textarea>
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">站点描述</label>
                <div class="layui-input-block">
                    <textarea name="description" lay-verify="" placeholder="站点描述" class="layui-textarea">{{  get_value($site, 'description') }}</textarea>
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">统计代码</label>
                <div class="layui-input-block">
                    <textarea name="statistics" lay-verify="" placeholder="统计代码" class="layui-textarea">{{  get_value($site, 'statistics') }}</textarea>
                </div>
            </div>

            <div class="layui-form-item">
                {{--<div class="layui-input-block">--}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                {{--</div>--}}
            </div>
        </form>
    </div>
@endsection

@section('scripts')
@endsection