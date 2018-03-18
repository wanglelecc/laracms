@extends('backend.layouts.app')

@section('title', $title = '友情链接列表')

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">友情链接</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <a href="{{ route('links.create') }}" class="layui-btn">添加</a>

        <div class="layui-form">
            @if($links->count())
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="60">
                        <col>
                        <col>
                        <col>
                        <col>
                        <col width="300">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>排序</th>
                        <th>名称</th>
                        <th>链接</th>
                        {{--<th>图标</th>--}}
                        <th>打开方式</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($links as $index => $link)
                        <tr>
                            <td>{{ $link->id }}</td>
                            <td>{{ $link->order}}</td>
                            <td>{{ $link->name}}</td>
                            <td>{{ $link->url}}</td>
                            {{--<td>{{ $link->icon}}</td>--}}
                            <td>@switch($link->target)
                                    @case('_self')当前窗口@break
                                    @case('_blank')新开窗口@break
                                @endswitch</td>
                            <td>@switch($link->status)
                                    @case(0)隐藏@break
                                    @case(1)显示@break
                                @endswitch</td>
                            <td>
                                <a href="{{ route('links.edit', $link->id) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                                <a href="javascript:;" data-url="{{ route('links.destroy', $link->id) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
    @include('backend.layouts._paginate',[ 'count' => $links->total(), ])
@endsection