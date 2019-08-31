@extends('frontend::layouts.app')

@section('title', $title = $category->name )
@section('description', empty($category->description) ? $category->description : config('system.common.basic.description','') )
@section('keywords', empty($category->keywords) ? $category->keywords : config('system.common.basic.keywords','') )

@section('breadcrumb')
    <a><cite>栏目</cite></a>
@endsection

@section('content')

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
                                <img src="{{ storage_image_url($article->thumb) }}" alt="interlij">
                            </a>
                            <h2>
                                {{--<a class="layui-badge">最新</a>--}}
                                <a href="{{$article->getLink($navigation,$category->id)}}">{{ $article->title  }}</a> </h2>
                            <div class="fly-list-info">
                                <a href="javascript:void(0);" link=""> <cite>{{ $article->getAuthor()  }}</cite> </a>
                                <span>{{ $article->getDate()  }}</span>
                                {{--<span class="fly-list-kiss layui-hide-xs" title="悬赏飞吻"><i class="iconfont icon-kiss"></i> 20</span>--}}
                                <span class="fly-list-nums"> <i class="iconfont" title="阅读"></i> {{$article->views}} </span>
                            </div>
                            <div class="fly-list-badge"></div>
                        </li>
                        @endforeach
                    </ul>

                    <div style="text-align: center">
                        {{ $articles->links('pagination::frontend') }}
                    </div>

                    @else
                        <div class="laypage-main"> 暂无数据. </div>
                    @endif



                </div>

            </div>

            <div class="layui-col-md4">
                @include('frontend::layouts._side')
            </div>


        </div>
    </div>

@endsection

@section('scripts')
    <script>
        layui.use(['carousel', 'form'], function(){
            var carousel = layui.carousel
                ,form = layui.form;

            //图片轮播
            carousel.render({
                elem: '#promo'
                ,width: '100%'
                ,height: '22rem'
                ,interval: 5000
            });

            //事件
            carousel.on('change(test4)', function(res){
                console.log(res)
            });

            var $ = layui.$, active = {
                set: function(othis){
                    var THIS = 'layui-bg-normal'
                        ,key = othis.data('key')
                        ,options = {};

                    othis.css('background-color', '#5FB878').siblings().removeAttr('style');
                    options[key] = othis.data('value');
                    ins3.reload(options);
                }
            };

            //监听开关
            form.on('switch(autoplay)', function(){
                ins3.reload({
                    autoplay: this.checked
                });
            });

            $('.demoSet').on('keyup', function(){
                var value = this.value
                    ,options = {};
                if(!/^\d+$/.test(value)) return;

                options[this.name] = value;
                ins3.reload(options);
            });

            //其它示例
            $('.demoTest .layui-btn').on('click', function(){
                var othis = $(this), type = othis.data('type');
                active[type] ? active[type].call(this, othis) : '';
            });
        });
    </script>
@endsection