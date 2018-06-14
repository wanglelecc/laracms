@extends('backend.layouts.app')

@section('title', $title = '内容列表')

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')

    @php
        $categoryHandler = app(\App\Handlers\CategoryHandler::class);
        $categorys = $categoryHandler->select($categoryHandler->getCategorys('article'));
        $category_id = request('category', 0);
        $keyword = request('keyword', '');
        $begin_time = request('begin_time', '');
        $end_time = request('end_time', '');
        $type = request('type', 'article');
    @endphp

<div class="layui-main">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>{{$title}}</legend>
    </fieldset>

    <form class="layui-form layui-form-pane" method="GET" action="">
    <input type="hidden" name="type" value="{{$type}}">
    <div class="layui-form-item">
        <a href="{{ route('articles.create') }}?type={{$type}}" class="layui-btn">添加</a>
        <button class="layui-btn layui-btn-danger" form="form-article-list">排序</button>

        <div style="float: right;">
        <div class="layui-inline">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-block">
                <select name="category" lay-filter="articles_category">
                    <option value=""></option>
                    @foreach($categorys as $key => $value)
                        <option @if($category_id == $key) selected @endif value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">开始时间</label>
            <div class="layui-input-inline">
                <input type="text" id="begin_time" name="begin_time" autocomplete="off" class="layui-input" value="{{$begin_time}}">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">结束时间</label>
            <div class="layui-input-inline">
                <input type="text" id="end_time" name="end_time" autocomplete="off" class="layui-input" value="{{$end_time}}">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">关键词</label>
            <div class="layui-input-inline">
                <input type="text" name="keyword" lay-verify="email" autocomplete="off" value="{{$keyword}}" class="layui-input">
            </div>
            {{--<input type="hidden" name="category" value="{{$category_id}}">--}}
            <input type="hidden" name="page" value="{{request('page',1)}}">
            <button type="submit" class="layui-btn layui-btn-normal">搜索</button>
        </div>
    </div>
    </div>
    </form>



    <div class="layui-form">
        @if($articles->count())
        <form name="form-article-list" id="form-article-list" class="layui-form layui-form-pane" method="POST" action="{{route('articles.order')}}">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <table class="layui-table">
            <colgroup>
                <col width="50">
                <col width=85">
                <col>
                <col>
                <col width="150">
                <col width="165">
                <col width="100">
                {{--<col width="130">--}}
                {{--<col width="100">--}}
                <col width="60">
                <col width="150">
            </colgroup>
            <thead>
            <tr>
                <th>#</th>
                <th>排序</th>
                <th>标题</th>
                <th>分类</th>
                <th>作者</th>
                <th>添加时间</th>
                <th>添加人</th>
                {{--<th>更新时间</th>--}}
                {{--<th>更新人</th>--}}
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $index => $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>
                    <input type="hidden" name="id[]" value="{{$article->id}}">
                    <input type="tel" name="order[]" lay-verify="required" autocomplete="off" class="layui-input" value="{{ $article->order  }}">
                </td>
                <td><a href="{{$article->getLink()}}" target="_blank">{{ $article->title  }}</a></td>
                <td class="text-center">{{ implode(' ', $article->categorys->pluck('name')->toArray() ) }}</td>
                <td>{{ $article->author  }}</td>
                <td>{{ $article->created_at}}</td>
                <td>{{ $article->created_user->name}}</td>
                {{--<td>{{ $article->updated_at->diffForHumans()}}</td>--}}
                {{--<td>{{ $article->updated_user->name}}</td>--}}
                <td>@switch($article->status)
                        @case(0)隐藏@break
                        @case(1)正常@break
                        @case(2)封禁@break
                    @endswitch</td>
                <td>
                    <a href="{{ route('articles.edit', $article->id) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                    <a href="javascript:;" data-url="{{ route('articles.destroy', $article->id) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </form>
        <form id="delete-form" action="" method="POST" style="display:none;">
            <input type="hidden" name="_method" value="DELETE">
            {{ csrf_field() }}
        </form>
        <div id="paginate-render"></div>
        @else
            <br />
            <blockquote class="layui-elem-quote">暂无数据!</blockquote>
        @endif

    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript">
        layui.form.on('select(articles_category)', function(data){
            var nUrl = window.jsUrlHelper.putUrlParam( window.location.href.toString(), 'category', data.value);
            window.location.href = nUrl;
        });

        layui.laydate.render({
            elem: '#begin_time'
        });

        layui.laydate.render({
            elem: '#end_time'
        });

    </script>
    @include('backend.layouts._paginate',[ 'count' => $articles->total(), ])
@endsection