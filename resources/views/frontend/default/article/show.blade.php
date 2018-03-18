@extends('frontend.default.layouts.app')

@section('title', $title = $article->title )
@section('description', $article->description)
@section('keywords', $article->keywords)

@section('breadcrumb')
    <a><cite>{{$title}}</cite></a>
@endsection

@section('content')
    <div class="layui-container">
          <div class="layui-row layui-col-space15">
            <div class="layui-col-md8 content detail">

                <div class="fly-panel detail-box">
                    <h1>{{$article->title}}</h1>
                    <div class="fly-detail-info">
                        <span class="layui-badge layui-bg-green fly-detail-column">{{$article->getAuthor()}}</span>
                        <span class="layui-badge" style="background-color: #999;">{{ $article->getDate()}}</span>
                        <div class="fly-admin-box" data-id="22739"> </div>
                        <span class="fly-list-nums">
                            {{--<a href="#comment"><i class="iconfont" title="评论"></i> 0</a>--}}
                            <i class="iconfont" title="人气"></i> {{$article->views}}
                        </span>
                    </div>
                    @if($article->description)
                    <div class="detail-about">
                        {{ $article->description }}
                    </div>
                    @endif
                    <div class="detail-body layui-text photos">
                        {!! $article->content !!}
                    </div>
                </div>

                <!--- ///////////////////////////////////////////////////// -->
                {{--@include('frontend.default.common._comment')--}}
            </div>

            <div class="layui-col-md4">
                @include('frontend.default.layouts._side')
            </div>

        </div>
    </div>

@endsection

@section('scripts')
@endsection