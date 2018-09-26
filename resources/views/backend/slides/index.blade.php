@extends('backend::layouts.app')

@section('title', $title = '幻灯片')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">幻灯管理</a></li>
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
                </div>
            </div>
            @if($slides->count())
                <table class="table table-bordered">
                    <colgroup>
                        <col width="50">
                        <col width="200">
                        <col width="300">
                        <col>
                        <col width="120">
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">标识</th>
                        <th class="text-center">名称</th>
                        <th class="text-center">描述</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slides as $index => $slide)
                        <tr>
                            <td class="text-center">{{ $slide['id'] }}</td>
                            <td>{{ $slide['mark']}}</td>
                            <td>{{ $slide['name']}}</td>
                            <td>{{ $slide['description']}}</td>
                            <td class="text-center">
                                <a href="{{ route('slides.manage', $slide['id']) }}" class="btn btn-xs btn-primary">管理</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')

@endsection