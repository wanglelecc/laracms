@extends('backend.layouts.app')

@section('title', $title = $wechat->id ? '详情' : '' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">wechat</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')

@endsection
