@extends('backend.layouts.app')

@section('title', $title = '区块列表')

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">区块管理</a>
    <a href="">{{$title}}</a>
@endsection
@section('content')
    <div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        @can('create', app(\App\Models\Block::class))
        <a href="{{ route('blocks.create') }}" class="layui-btn">添加</a>
        @endcan

        <div class="layui-form">
            @if($blocks->count())
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="100">
                        <col width="180">
                        <col>
                        <col width="300">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>标识</th>
                        <th>类型</th>
                        <th>名称</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blocks as $index => $block)
                        <tr>
                            <td>{{ $block->id }}</td>
                            <td>{{ $block->object_id }}</td>
                            <td>{{ config('blocks.types.'.$block->type)}}</td>
                            <td>{{ $block->title}}</td>
                            <td>
                                <a href="{{ route('blocks.edit', $block->id) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                                @can('destroy', $block)
                                <a href="javascript:;" data-url="{{ route('blocks.destroy', $block->id) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
                                @endcan
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
    @include('backend.layouts._paginate',[ 'count' => $blocks->total(), ])
@endsection