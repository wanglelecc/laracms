@extends('frontend::layouts.app')

@section('title', $title = $article->title )
@section('description', empty($article->description) ? $article->description : config('system.common.basic.description','') )
@section('keywords', empty($article->keywords) ? $article->keywords : config('system.common.basic.keywords','') )

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
                        <span class="layui-badge layui-bg-green fly-detail-column">{{$article->author}}</span>
                        <span class="layui-badge" style="background-color: #999;">{{ $article->created_at->toDateString()}}</span>
                        <div class="fly-admin-box" data-id="22739"> </div>
                        <span class="fly-list-nums">
                            <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> {{$article->reply_count}}</a>
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
                <div class="fly-panel detail-box" id="flyReply">
                    <fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
                        <legend>回复</legend>
                    </fieldset>
                    @include('frontend::article._reply_list', ['replies' => $article->replies()->with('user')->get()])
                    @includeWhen(Auth::check(),'frontend::article._reply_box', ['article' => $article])
                    <form id="delete-reply-form" action="" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
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
    $(".form-reply-delete").click(function(){

    var tUrl = $(this).attr('data-url');

    layer.confirm('确认删除吗？', {
    btn: ['确认', '取消']
    }, function(index){
    $("#delete-reply-form").attr("action",tUrl).submit();
        console.log(tUrl);
        layer.close(index);
    return false;
    }, function(index){
        layer.close(index);
    return true;
    });

    return false;
    });
</script>
@endsection