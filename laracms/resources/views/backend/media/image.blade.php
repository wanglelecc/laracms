@extends('backend::layouts.app')

@section('title', $title = '图片管理')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">媒体管理</a></li>
    <li><a href="javascript:;">{{ $title }}</a></li>
    <li class="active">@switch($folder)
            @case('article')文章@break
            @case('slide')幻灯@break
            @case('avatar')头像@break
            @default全部@break
        @endswitch</li>
@endsection

@section('tab')
    <ul class="nav nav-tabs">
        <li class="@if($folder == '' || $folder == 'all') active @endif"><a href="{{ route('media.image') }}?folder=">全部</a></li>
        <li class="@if($folder == 'article') active @endif"><a href="{{ route('media.image') }}?folder=article">文章</a></li>
        <li class="@if($folder == 'slide') active @endif"><a href="{{ route('media.image') }}?folder=slide">幻灯</a></li>
        <li class="@if($folder == 'avatar') active @endif"><a href="{{ route('media.image') }}?folder=avatar">头像</a></li>
    </ul>
    <br />
@endsection

@section('content')
    {{--<h2 class="header-dividing">{{$title}} <small></small></h2>--}}
    <div class="row">
        <div class="col-md-12">
            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                </div>
                <div class="tools-group">
                </div>
            </div>

            @if($images->count())
                <div class="panel">
                    <div class="panel-body">

                        <div class="row">
                        @foreach($images as $image)
                        <div class="col-md-3 col-sm-4 col-lg-2">
                            <div class="card" href="###">
                                <div class="media-wrapper">
                                    <img src="{{ storage_image_url($image->path) }}" alt="{{$image->title}}" style="height: 166px;">
                                </div>
                                <div class="card-heading"><strong>{{$image->title}}</strong></div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                        <div id="paginate-render">
                            {{$images->links('pagination::backend')}}
                        </div>

                    </div>
                </div>
            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')

@endsection