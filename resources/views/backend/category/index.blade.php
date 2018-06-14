@extends('backend.layouts.app')

@section('title', $title = '分类列表')

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">@switch($type)
            @case('article')文章分类@break
        @endswitch</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <a href="{{ route('administrator.category.create', [$type, 0]) }}" class="layui-btn">添加</a>
        <button class="layui-btn layui-btn-danger" form="form-category-list">排序</button>

        <div class="layui-form">
            @if(count($categorys))
                <form name="form-article-list" id="form-category-list" class="layui-form layui-form-pane" method="POST" action="{{route('administrator.category.order', $type)}}">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="85">
                        <col>
                        <col width="300">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>排序</th>
                        <th>名称</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categorys as $index => $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                <input type="hidden" name="id[]" value="{{$category->id}}">
                                <input type="tel" name="order[]" lay-verify="required" autocomplete="off" class="layui-input" value="{{ $category->order  }}">
                            </td>
                            <td>{{ str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$category->lavel)}}@if($category->lavel > 0)├─ @endif{{ $category->name}}</td>
                            <td>
                                <a href="{{ route('administrator.category.create', [$type, $category->id]) }}" class="layui-btn layui-btn-sm">添加子菜单</a>
                                <a href="{{ route('administrator.category.edit', [$category->id, $type]) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                                <a href="javascript:;" data-url="{{ route('administrator.category.destroy', [$category->id,$type]) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
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

    <script>
        layui.use(['laypage', 'layer'], function(){
            var laypage = layui.laypage
                ,layer = layui.layer;

            $(".form-delete").click(function(){

                var tUrl = $(this).attr('data-url');

                layer.confirm('确认删除吗？', {
                    btn: ['确认', '取消']
                }, function(index){
                    $("#delete-form").attr("action",tUrl).submit();
                    console.log(tUrl);
                    layer.close(index);
                    return false;
                }, function(index){
                    layer.close(index);
                    return true;
                });

                return false;
            });
        });
    </script>
@endsection