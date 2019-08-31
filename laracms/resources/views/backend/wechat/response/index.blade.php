@extends('backend::layouts.app')

@section('title', $title = '关键字回复')

@section('navigation')
    <a class="btn btn-primary btn-xs" href="{{ route('wechats.index') }}">微信管理</a>
@endsection

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li><a href="javascript:;">微信管理</a></li>
    <li><a href="javascript:;">回复管理</a></li>
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
                    <a href="{{ route('wechat.response.create', [$wechat->id, 0]) }}" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                </div>
            </div>
                @if($wechat_responses->count())
                <form name="form-list" id="form-list" class="" method="POST" action="">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <table class="table table-bordered">
                        <colgroup>
                            <col width="50">
                            <col width="200">
                            <col width="100">
                            <col>
                            <col width="130">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">名称</th>
                            <th class="text-center">类型</th>
                            <th class="text-center">值</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wechat_responses as $index => $wechat_response)
                            <tr>
                                <td class="text-center">{{ $wechat_response->id }}</td>
                                <td class="text-center">{{$wechat_response->key}}</td>
                                <td class="text-center">@switch($wechat_response->type)
                                        @case('text') 文本 @break
                                        @case('link') 链接 @break
                                        @case('news') 图文 @break
                                    @endswitch</td>
                                <td class="text-center">@switch($wechat_response->type)
                                        @case('text') {{get_json_params($wechat_response->content,'text')}} @break
                                        @case('link') {{get_json_params($wechat_response->content,'link')}} @break
                                        @case('news') 文章：{{get_json_params($wechat_response->content,'category_name')}} @break
                                    @endswitch</td>
                                <td class="text-center">
                                    <a href="{{ route('wechat.response.edit', [$wechat_response->id, $wechat_response->wechat_id]) }}" class="btn btn-xs btn-primary">编辑</a>
                                    <a href="javascript:;" data-url="{{ route('wechat.response.destroy', [$wechat_response->id, $wechat_response->wechat_id]) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
                <div id="paginate-render">
                    {{$wechat_responses->links('pagination::backend')}}
                </div>
            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection


@section('scripts')
    @include('backend::layouts._paginate',[ 'count' => $wechat_responses->count(), ])
@endsection