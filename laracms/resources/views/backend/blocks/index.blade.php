@extends('backend::layouts.app')

@section('title', $title = '区块列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">区块管理</a></li>
    <li class="active">{{$title}}</li>
@endsection
@section('content')
    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">

            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                </div>
                <div class="tools-group">
                    @can('create', app(\Wanglelecc\Laracms\Models\Block::class))
                        <a href="{{ route('blocks.create') }}" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                    @endcan
                </div>
            </div>
            @if($blocks->count())
                <table class="table table-bordered">

                    <colgroup>
                        <col width="50">
                        <col width="330">
                        <col width="180">
                        <col>
                        <col width="120">
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">标识</th>
                        <th class="text-center">类型</th>
                        <th class="text-center">名称</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blocks as $index => $block)
                        <tr>
                            <td class="text-center">{{ $block->id }}</td>
                            <td class="text-center">{{ $block->object_id }}</td>
                            <td class="text-center">{{ config('blocks.types.'.$block->type)}}</td>
                            <td>{{ $block->title}}</td>
                            <td class="text-center">
                                <a href="{{ route('blocks.edit', $block->id) }}" class="btn btn-xs btn-primary">编辑</a>
                                @can('destroy', $block)
                                    <a href="javascript:;" data-url="{{ route('blocks.destroy', $block->id) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            <div id="paginate-render">
                {{$blocks->links('pagination::backend')}}
            </div>
            @else
            <div class="alert alert-info alert-block">暂无数据</div>
            @endif
            </div>
    </div>
@endsection

@section('scripts')
    @include('backend::layouts._paginate',[ 'count' => $blocks->total(), ])
@endsection