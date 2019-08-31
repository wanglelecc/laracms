

@extends('frontend::layouts.app')

@section('title', $title = empty($query) ? '搜索' : $query . ' - 搜索' )
@section('description', config('system.common.basic.description','') )
@section('keywords', config('system.common.basic.keywords','') )

@php
$breadcrumb = false;
@endphp

@section('content')

    <div class="fly-panel fly-column">
        <div class="layui-container">
            <div class="fly-column-left layui-hide-xs">
                <form class="layui-form" action="{{route('search')}}" method="get">
                    <div class="layui-form-item1">
                        <div class="layui-input-inline" style="width: 300px;">
                            <input type="text" name="query" lay-verify="title" autocomplete="off" placeholder="请输入关键字" value="{{$query}}" class="layui-input">
                        </div>
                        <div class="layui-input-inline" style="margin-top: -3px;">
                            <button class="layui-btn" type="submit">搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="layui-container fly-marginTop">
         <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="fly-panel">

                    <div class="fly-panel-title fly-filter">
                        <a href="javascript:;" class="layui-this">搜索结果</a>
                        {{--<span class="fly-mid"></span>--}}
                        {{--<a href="">商品</a>--}}
                        {{--<span class="fly-mid"></span>--}}
                        {{--<a href="">博客</a>--}}
                        {{--<span class="fly-mid"></span>--}}
                        {{--<a href="">文档</a>--}}
                        {{--<span class="fly-filter-right layui-hide-xs">--}}
                            {{--<a href="" class="layui-this">按最新</a>--}}
                            {{--<span class="fly-mid"></span>--}}
                            {{--<a href="">按热议</a>--}}
                        {{--</span>--}}
                    </div>

                    @if($articles->count())
                    <ul class="fly-list search-list">
                        @foreach($articles as $index => $article)
                        <li>
                            <h2><a target="_blank" href="{{$article->getLink(0,0)}}">{!! str_replace($query,"<strong>{$query}</strong>",$article->title) !!}</a> </h2>
                            <p>{!! str_replace($query, "<strong>{$query}</strong>", $article->description) !!}  </p>
                            <p><a target="_blank" href="{{$article->getLink(0,0)}}">{{$article->getLink(0,0)}}</a><span>{{ $article->created_at->toDateString()}}</span></p>
                            <div class="fly-list-badge"></div>
                        </li>
                        @endforeach
                    </ul>

                    <div style="text-align: left; margin-left: 15px;">
                        {{ $articles->links('pagination::frontend') }}
                    </div>

                    @else
                        <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><span>暂无搜索结果！</span></div>
                    @endif


                </div>

            </div>

            <div class="layui-col-md4">

            </div>


        </div>
    </div>

@endsection

@section('scripts')
@endsection