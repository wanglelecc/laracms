@extends('backend.layouts.app')

@section('title', $title = $block->id ? '编辑区块' : '添加区块' )

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">区块管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" method="POST" action="{{ $block->id ? route('blocks.update', $block->id) : route('blocks.store') }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="{{ $block->id ? 'PATCH' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label">类型</label>
                <div class="layui-input-block">
                    @if($block->id)
                        <input type="hidden" name="type" value="{{$block->type}}" />
                        <input type="text"  class="layui-input" disabled value="{{ config('blocks.types.'.$block->type)}}">
                    @else
                        <select name="type" lay-filter="block_type">
                            <option value=""></option>
                            @foreach(config('blocks.types') as $key => $value)
                            <option @if($type == $key) selected @endif value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">名称</label>
                <div class="layui-input-block">
                    <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="请输入名称" class="layui-input" value="{{ old('title',$block->title) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">更多文字</label>
                <div class="layui-input-block">
                    <input type="text" name="more_title" lay-verify="" autocomplete="off" placeholder="请输入更多链接文字" class="layui-input" value="{{ old('more_title',$block->more_title) }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">更多地址</label>
                <div class="layui-input-block">
                    <input type="url" name="more_link" lay-verify="" autocomplete="off" placeholder="更多链接地址" class="layui-input" value="{{ old('more_link',$block->more_link) }}" >
                </div>
            </div>

            @if($type)
                @include('backend.blocks.template.'.$type,['block' => $block])
            @endif

            <div class="layui-form-item">
                {{--<div class="layui-input-block">--}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                {{--</div>--}}
            </div>
        </form>
    </div>
@endsection


@section('styles')
    @include('backend.common._editor_styles')
    @include('backend.common._code_editor_styles')
@stop

@section('scripts')
    <script type="text/javascript">
        layui.form.on('select(block_type)', function(data){
            var nUrl = window.jsUrlHelper.putUrlParam( window.location.href.toString(), 'type', data.value);
            window.location.href = nUrl;
        });
    </script>
    @include('backend.common._editor_scripts',['folder'=>'block'])
    @include('backend.common._code_editor_scripts',['folder'=>'block'])
@endsection