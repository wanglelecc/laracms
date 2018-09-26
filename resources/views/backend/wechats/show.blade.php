@extends('backend::layouts.app')

@section('title', $title = $wechat->id ? '详情' : '' )

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li><a href="javascript:;">微信管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

@endsection
