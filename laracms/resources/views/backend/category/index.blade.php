@extends('backend::layouts.app')

@section('title', $title = '分类列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">@switch($type)
            @case('article')文章分类@break
        @endswitch</a>
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
                    <a href="{{ route('administrator.category.create', [$type, 0]) }}"  class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                    <button class="btn btn-danger" form="form-category-list"><i class="icon icon-sort-by-order-alt"></i> 排序</button>
                </div>
            </div>

            @if(count($categorys))
                <form name="form-article-list" id="form-category-list" class="layui-form layui-form-pane2" method="POST" action="{{route('administrator.category.order', $type)}}">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <table class="table table-bordered">
                        <colgroup>
                            <col width="50">
                            <col width="85">
                            <col>
                            <col width="170">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">排序</th>
                            <th class="text-left">名称</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categorys as $index => $category)
                            <tr>
                                <td class="text-center">{{ $category->id }}</td>
                                <td class="text-center">
                                    <input type="hidden" name="id[]" value="{{$category->id}}">
                                    <input type="tel" name="order[]" autocomplete="off" class="form-control text-center" value="{{ $category->order  }}">
                                </td>
                                <td>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$category->lavel) !!}@if($category->lavel > 0)├─ @endif{{ $category->name}}</td>
                                <td class="text-center">
                                    <a href="{{ route('administrator.category.create', [$type, $category->id]) }}" class="btn btn-xs btn-success">添加</a>
                                    <a href="{{ route('administrator.category.edit', [$category->id, $type]) }}" class="btn btn-xs btn-primary">编辑</a>
                                    <a href="javascript:;" data-url="{{ route('administrator.category.destroy', [$category->id,$type]) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')

@endsection