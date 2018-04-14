@extends('backend.layouts.app')

@section('title', $title = '导航')

@section('breadcrumb')
<a href="">站点设置</a>
<a href="">栏目导航</a>
<a href="">@switch($category)
        @case('desktop')主导航@break
        @case('footer')底部导航@break
        @case('mobile')手机导航@break
    @endswitch</a>
@endsection

@section('tab')
<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
    <ul class="layui-tab-title">
        <li class="@if($category == 'desktop') layui-this @endif"><a href="{{ route('administrator.navigation.index', 'desktop') }}">主导航</a></li>
        <li class="@if($category == 'footer') layui-this @endif"><a href="{{ route('administrator.navigation.index', 'footer') }}">底部导航</a></li>
        <li class="@if($category == 'mobile') layui-this @endif"><a href="{{ route('administrator.navigation.index', 'mobile') }}">手机导航</a></li>
    </ul>
</div>
@endsection

@section('content')
    <div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <a href="{{ route('administrator.navigation.create', [$category, 0]) }}" class="layui-btn">添加</a>
        <button class="layui-btn layui-btn-danger" form="form-navigation-list">排序</button>

        <div class="layui-form">
            @if(count($navigations))
                <form name="form-article-list" id="form-navigation-list" class="layui-form layui-form-pane" method="POST" action="{{route('administrator.navigation.order', $category)}}">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="85">
                        <col>
                        <col width="60">
                        <col width="300">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>排序</th>
                        <th>名称</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($navigations as $index => $navigation)
                        <tr>
                            <td>{{ $navigation->id }}</td>
                            <td>
                                <input type="hidden" name="id[]" value="{{$navigation->id}}">
                                <input type="tel" name="order[]" lay-verify="required" autocomplete="off" class="layui-input" value="{{ $navigation->order  }}">
                            </td>
                            <td>{{ str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$navigation->lavel)}}@if($navigation->lavel > 0)├─ @endif{{ $navigation->title}}</td>
                            <td>@switch($navigation->is_show)
                                    @case(0)隐藏@break
                                    @case(1)显示@break
                                @endswitch</td>
                            <td>
                                <a href="{{ route('administrator.navigation.create', [$category, $navigation->id]) }}" class="layui-btn layui-btn-sm">添加子导航</a>
                                <a href="{{ route('administrator.navigation.edit', [$navigation->id, $category]) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                                <a href="javascript:;" data-url="{{ route('administrator.navigation.destroy', [$navigation->id,$category]) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
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