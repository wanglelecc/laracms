@extends('backend::layouts.app')

@section('title', $title = '微信列表')

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li><a href="javascript:;">微信管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">

            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                </div>
                <div class="tools-group">
                    <a href="{{ route('wechats.create') }}" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                </div>
            </div>
            @if($wechats->count())

                <form name="form-list" id="form-list" class="" method="POST" action="{{route('wechats.order')}}">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <table class="table table-bordered">
                        <colgroup>
                            <col width="50">
                            <col width="">
                            <col>
                            <col>
                            <col>
                            <col width="450">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            {{--<th class="text-center">排序</th>--}}
                            <th class="text-center">微信名</th>
                            <th class="text-center">类型</th>
                            <th class="text-center">原始ID</th>
                            <th class="text-center">AppID</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wechats as $index => $wechat)
                            <tr>
                                <td class="text-center">{{ $wechat->id }}</td>
                                {{--<td>--}}
                                {{--<input type="hidden" name="id[]" value="{{$wechat->id}}">--}}
                                {{--<input type="tel" name="order[]" lay-verify="required" autocomplete="off" class="layui-input" value="{{ $wechat->order  }}">--}}
                                {{--</td>--}}
                                <td>{{$wechat->name}}</td>
                                <td>@if($wechat->type == 'subscribe') 订阅号 @else 服务号 @endif</td>
                                <td>{{$wechat->account}}</td>
                                <td>{{$wechat->app_id}}</td>
                                <td class="text-center">
                                    <a href="{{ route('wechats.edit', $wechat->id) }}" class="btn btn-xs btn-primary">编辑</a>
                                    <a href="{{ route('wechat.menus.index', $wechat->id) }}" class="btn btn-xs btn-info">菜单</a>
                                    <a href="{{ route('wechat.response.index', $wechat->id) }}" class="btn btn-xs btn-warning">关键字</a>
                                    <a href="{{ route('wechat.response.set.response.create', [$wechat->id, 'default']) }}" class="btn btn-xs btn-normal">默认响应</a>
                                    <a href="{{ route('wechat.response.set.response.create', [$wechat->id, 'subscribe']) }}" class="btn btn-xs btn-normal">订阅响应</a>
                                    <a href="{{ route('wechats.integrate', $wechat->id) }}" class="btn btn-xs btn-success">接入</a>
                                    {{--<a href="{{ route('wechats.edit', $wechat->id) }}" class="btn btn-xs btn-normal">二维码</a>--}}
                                    <a href="javascript:;" data-url="{{ route('wechats.destroy', $wechat->id) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>


                <div id="paginate-render">
                    {{$wechats->links('pagination::backend')}}
                </div>
            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection


@section('scripts')

@endsection