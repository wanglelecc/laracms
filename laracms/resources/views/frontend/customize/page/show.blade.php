@extends('frontend::layouts.app')

@section('title', $title = $page->title)
@section('description',  empty($page->description) ? $page->description : config('system.common.basic.description',''))
@section('keywords', empty($page->keywords) ? $page->keywords : config('system.common.basic.keywords',''))

@section('breadcrumb')
    {{--<a><cite>{{$title}}</cite></a>--}}
@endsection

@section('content')
    <div class="layui-container">
          <div class="layui-row layui-col-space15">
            <div class="layui-col-md12 content detail">

                <!--- ///////////////////////////////////////////////////// -->

                <div class="fly-panel detail-box">
                    <h1>{{$page->title}}</h1>
                    <div class="fly-detail-info">
                        <span class="layui-badge layui-bg-green fly-detail-column">{{ $page->author }}</span>
                        <span class="layui-badge" style="background-color: #999;">{{ $page->updated_at->toDateString() }}</span>
                        <div class="fly-admin-box" data-id="22739"> </div>
                        <span class="fly-list-nums">
                            {{--<a href="#comment"><i class="iconfont" title="评论"></i> 0</a>--}}
                            <i class="iconfont" title="人气"></i> {{ $page->views }}
                        </span>
                    </div>
                    @if($page->description && false)
                    <div class="detail-about">
                        {{ $page->description }}
                    </div>
                    @endif
                    <div class="detail-body layui-text photos">
                        {!! $page->content !!}
                    </div>
                </div>

                <!--- ///////////////////////////////////////////////////// -->
                {{--@include('frontend::common._comment')--}}
            </div>

            {{--<div class="layui-col-md4">--}}
                {{--@include('frontend::layouts._side')--}}
            {{--</div>--}}

        </div>
    </div>

@endsection

@section('scripts')
@endsection