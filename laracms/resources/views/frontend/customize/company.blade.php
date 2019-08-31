@extends('frontend::layouts.app')

@section('title', $title = '关于我们')
@section('description', config("system.common.basic.description"))
@section('keywords', config("system.common.basic.keywords"))

@section('breadcrumb')
    {{--<a><cite>{{$title}}</cite></a>--}}
@endsection

@section('content')
    <div class="layui-container">
          <div class="layui-row layui-col-space15">
            <div class="layui-col-md12 content detail">
                <div class="fly-panel detail-box">
                    <h1>{{$title}}</h1>
                    <div class="detail-body layui-text photos">
                        {!! config("system.common.company.content") !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection