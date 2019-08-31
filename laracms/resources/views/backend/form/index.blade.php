@extends('backend::layouts.app')

@section('title', $title = $form['title'])

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li>{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">

            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                </div>
                <div class="tools-group">

                </div>
            </div>

            @if($forms->count())
                <table class="table table-bordered">
                    <colgroup>
                        <col width="50">
                        <col width="80">
                        @foreach($form['field'] as $key => $field) @if($field['listShow'])
                            <col width="{{ $field['width'] ?? '' }}">
                        @endif @endforeach
                        <col width="120">
                        <col width="150">
                        <col width="170">
                        <col width="80">
                        <col width="130">
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">用户</th>
                        @foreach($form['field'] as $key => $field) @if($field['listShow'])
                            <th class="text-center">{{ $field['name'] }}</th>
                        @endif @endforeach
                        <th class="text-center">IP</th>
                        <th class="text-center">地址</th>
                        <th class="text-center">时间</th>
                        <th class="text-center">状态</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($forms as $index => $value)
                        <tr>
                            <td class="text-center">{{ $value->id }}</td>
                            <td class="text-center">{{ $value->user->name ?? '匿名' }}</td>
                            @foreach($form['field'] as $key => $field) @if($field['listShow'])
                            <td class="{{ $field['class'] ?? '' }}">{{ get_form_value($value->$key, $field) }}</td>
                            @endif @endforeach
                            <td class="text-center">{{ $value->ip}}</td>
                            <td class="text-center">{{ $value->location}}</td>
                            <td class="text-center">{{ $value->created_at}}</td>
                            <td class="text-center">@switch($value->status)
                                    @case(0)<span class="label label-badge label-danger">隐藏</span>@break
                                    @case(1)<span class="label label-badge label-success">正常</span>@break
                                @endswitch</td>
                            <td class="text-center">
                                <a href="{{ route('form.show', [$value->id, $type]) }}" class="btn btn-xs btn-primary">查看</a>
                                <a href="javascript:;" data-url="{{ route('form.destroy', [$value->id, $type]) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            <div id="paginate-render">
                {{$forms->links('pagination::backend')}}
            </div>
            @else
            <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')

@endsection