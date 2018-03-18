@extends('backend.layouts.app')

@section('title', $title = '微信列表')

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

        <a href="{{ route('wechats.create') }}" class="layui-btn">添加</a>
        {{--<button class="layui-btn layui-btn-danger" form="form-list">排序</button>--}}

        <div class="layui-form">
            @if($wechats->count())
            <form name="form-list" id="form-list" class="layui-form layui-form-pane" method="POST" action="{{route('wechats.order')}}">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="">
                        <col>
                        <col>
                        <col>
                        <col width="600">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        {{--<th>排序</th>--}}
                        <th>微信名</th>
                        <th>类型</th>
                        <th>原始ID</th>
                        <th>AppID</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wechats as $index => $wechat)
                        <tr>
                            <td>{{ $wechat->id }}</td>
                            {{--<td>--}}
                                {{--<input type="hidden" name="id[]" value="{{$wechat->id}}">--}}
                                {{--<input type="tel" name="order[]" lay-verify="required" autocomplete="off" class="layui-input" value="{{ $wechat->order  }}">--}}
                            {{--</td>--}}
                            <td>{{$wechat->name}}</td>
                            <td>@if($wechat->type == 'subscribe') 订阅号 @else 服务号 @endif</td>
                            <td>{{$wechat->account}}</td>
                            <td>{{$wechat->app_id}}</td>
                            <td>
                                <a href="{{ route('wechats.edit', $wechat->id) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                                <a href="{{ route('wechat_menus.index', $wechat->id) }}" class="layui-btn layui-btn-sm">菜单</a>
                                <a href="{{ route('wechat_response.index', $wechat->id) }}" class="layui-btn layui-btn-sm layui-btn-normal">关键字</a>
                                <a href="{{ route('wechat_response.set_response.create', [$wechat->id, 'default']) }}" class="layui-btn layui-btn-sm layui-btn-normal">默认响应</a>
                                <a href="{{ route('wechat_response.set_response.create', [$wechat->id, 'subscribe']) }}" class="layui-btn layui-btn-sm layui-btn-normal">订阅响应</a>
                                <a href="{{ route('wechats.integrate', $wechat->id) }}" class="layui-btn layui-btn-sm layui-btn-warm">接入</a>
                                {{--<a href="{{ route('wechats.edit', $wechat->id) }}" class="layui-btn layui-btn-sm layui-btn-normal">二维码</a>--}}
                                <a href="javascript:;" data-url="{{ route('wechats.destroy', $wechat->id) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
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
    @include('backend.layouts._paginate',[ 'count' => $wechats->total(), ])
@endsection