

@extends('frontend.default.layouts.app')

@section('title', $title = $category->name )
@section('description', '')
@section('keywords', '')

@section('breadcrumb')
    {{--<a><cite>列表</cite></a>--}}
@endsection

@section('content')
    @php
        $currentBrothersAndChildNavigation = frontend_current_brother_and_child_navigation('desktop',true);
    @endphp
    <div class="layui-container">
         <div class="layui-row layui-col-space15">
            <div class="layui-col-md8">
                <div class="fly-panel">
                    <div class="fly-panel-title fly-filter"> <a>{{$title}}</a> <a href="#signin" class="layui-hide-sm layui-show-xs-block fly-right" id="LAY_goSignin" style="color: #FF5722;">去签到</a> </div>
                    @if($articles->count())
                    <ul class="fly-list">
                        @foreach($articles as $index => $article)
                        <li>
                            <a href="{{$article->getLink($navigation,$category->id)}}" class="fly-avatar">
                                <img src="{{$article->getThumb()}}" alt="interlij">
                            </a>
                            <h2>
                                {{--<a class="layui-badge">最新</a>--}}
                                <a href="{{$article->getLink($navigation,$category->id)}}">{{ $article->title  }}</a> </h2>
                            <div class="fly-list-info">
                                <a href="javascript:void(0);" link=""> <cite>{{ $article->getAuthor()  }}</cite> </a>
                                <span>{{ $article->getDate()  }}</span>
                                {{--<span class="fly-list-kiss layui-hide-xs" title="悬赏飞吻"><i class="iconfont icon-kiss"></i> 20</span>--}}
                                <span class="fly-list-nums">
                                    <i class="iconfont icon-pinglun1" title="回答"></i> {{ $article->reply_count }}
                                    <i class="iconfont" title="阅读"></i> {{$article->views}}
                                </span>
                            </div>
                            <div class="fly-list-badge"></div>
                        </li>
                        @endforeach
                    </ul>

                    <div style="text-align: center">
                        {{ $articles->links('frontend.default.pagination.default') }}
                        {{--{{ $articles->links() }}--}}
                    </div>

                    @else
                        <div class="laypage-main"> 暂无数据. </div>
                    @endif



                </div>

            </div>

            <div class="layui-col-md4">
                <div class="fly-panel">
                    <div class="fly-panel-title"> 分类 </div>
                    <div class="fly-panel-main">
                        @if($currentBrothersAndChildNavigation)
                        @foreach($currentBrothersAndChildNavigation as $navigation)
                        <a target="{{ $navigation->target }}" href="{{$navigation->link}}" rel="nofollow" class="fly-category @if(request('navigation',0)==$navigation->id)fly-category-this @endif">{{$navigation->title}}</a>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection

@section('scripts')
@endsection