@extends('backend.layouts.app')

@section('title', $title = '关键字回复')

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">微信管理</a>
    <a href="">回复管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')

<div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <a href="{{ route('wechat_response.create', [$wechat->id, 0]) }}" class="layui-btn">添加</a>
        {{--<button class="layui-btn layui-btn-danger" form="form-list">排序</button>--}}

        <div class="layui-form">
            @if($wechat_responses->count())
            <form name="form-list" id="form-list" class="layui-form layui-form-pane" method="POST" action="">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col>
                        <col>
                        <col>
                        <col width="300">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>名称</th>
                        <th>类型</th>
                        <th>值</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wechat_responses as $index => $wechat_response)
                        <tr>
                            <td>{{ $wechat_response->id }}</td>
                            <td>{{$wechat_response->key}}</td>
                            <td>@switch($wechat_response->type)
                                    @case('text') 文本 @break
                                    @case('link') 链接 @break
                                    @case('news') 图文 @break
                                @endswitch</td>
                            <td>@switch($wechat_response->type)
                                    @case('text') {{get_json_params($wechat_response->content,'text')}} @break
                                    @case('link') {{get_json_params($wechat_response->content,'link')}} @break
                                    @case('news') 文章：{{get_json_params($wechat_response->content,'category_name')}} @break
                                @endswitch</td>
                            <td>
                                <a href="{{ route('wechat_response.edit', [$wechat_response->id, $wechat_response->wechat_id]) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                                <a href="javascript:;" data-url="{{ route('wechat_response.destroy', [$wechat_response->id, $wechat_response->wechat_id]) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </form>
                <form id="delete-form" action="" method="POST" style="display:none;">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                </form>
                <div id="paginate-render"></div>
            @else
                <br />
                <blockquote class="layui-elem-quote">暂无数据!</blockquote>
            @endif

        </div>
    </div>
@endsection


@section('scripts')
    @include('backend.layouts._paginate',[ 'count' => $wechat_responses->count(), ])
@endsection