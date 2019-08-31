@extends('backend::layouts.app')

@section('title', $title = '导航')

@section('breadcrumb')
<li><a href="javascript:;">站点设置</a></li>
<li><a href="javascript:;">栏目导航</a></li>
<li class="active">@switch($category)
        @case('desktop')主导航@break
        @case('footer')底部导航@break
        @case('mobile')手机导航@break
    @endswitch</li>
@endsection

@section('tab')
<ul class="nav nav-tabs">
    <li class="@if($category == 'desktop') active @endif"><a href="{{ route('administrator.navigation.index', 'desktop') }}">主导航</a></li>
    <li class="@if($category == 'footer') active @endif"><a href="{{ route('administrator.navigation.index', 'footer') }}">底部导航</a></li>
    <li class="@if($category == 'mobile') active @endif"><a href="{{ route('administrator.navigation.index', 'mobile') }}">手机导航</a></li>
</ul>
<br />
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                </div>
                <div class="tools-group">
                    <a href="{{ route('administrator.navigation.create', [$category, 0]) }}" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                    <button class="btn btn-danger" form="form-navigation-list"><i class="icon icon-sort-by-order-alt"></i> 排序</button>
                </div>
            </div>

            @if(count($navigations))

                <form name="form-article-list" id="form-navigation-list" class="layui-form layui-form-pane" method="POST" action="{{route('administrator.navigation.order', $category)}}">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <table class="table table-bordered">
                        <colgroup>
                            <col width="50">
                            <col width="70">
                            <col>
                            <col width="70">
                            <col width="150">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">排序</th>
                            <th class="text-center">名称</th>
                            <th class="text-center">状态</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($navigations as $index => $navigation)
                            <tr>
                                <td class="text-center">{{ $navigation->id }}</td>
                                <td>
                                    <input type="hidden" name="id[]" value="{{$navigation->id}}">
                                    <input type="tel" name="order[]" autocomplete="off" class="form-control text-center" value="{{ $navigation->order  }}">
                                </td>
                                <td>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$navigation->lavel) !!} @if($navigation->lavel > 0)├─ @endif{{ $navigation->title}}</td>
                                <td class="text-center">@switch($navigation->is_show)
                                        @case(0)<span class="label label-badge label-danger">隐藏</span>@break
                                        @case(1)<span class="label label-badge label-success">正常</span>@break
                                    @endswitch</td>
                                <td class="text-center">
                                    <a href="{{ route('administrator.navigation.create', [$category, $navigation->id]) }}" class="btn btn-xs btn-info">添加</a>
                                    <a href="{{ route('administrator.navigation.edit', [$navigation->id, $category]) }}" class="btn btn-xs btn-primary">编辑</a>
                                    <a href="javascript:;" data-url="{{ route('administrator.navigation.destroy', [$navigation->id,$category]) }}" class="btn btn-xs btn-danger form-delete">删除</a>
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