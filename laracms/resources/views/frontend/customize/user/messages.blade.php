@extends('frontend::layouts.app')

@section('title', $title = '我的消息')

@php
    $breadcrumb = false;
@endphp

@section('breadcrumb')
    <a><cite>{{$title}}</cite></a>
@endsection

@section('content')
    <div class="layui-container fly-marginTop fly-user-main">

        @include('frontend::user._side', ['side'=>'messages'])

        <div class="fly-panel fly-panel-user" pad20>
            <div class="layui-tab layui-tab-brief" lay-filter="user" id="LAY_msg" style="margin-top: 15px;">
                <button class="layui-btn layui-btn-danger" id="LAY_delallmsg">清空全部消息</button>
                <div  id="LAY_minemsg" style="margin-top: 10px;">
                    <!--<div class="fly-none">您暂时没有最新消息</div>-->
                    @if ($notifications->count())
                    <ul class="mine-msg">
                        @foreach ($notifications as $notification)
                            @include('frontend::notifications.types._' . snake_case(class_basename($notification->type)), ['notification'=>$notification])
                        @endforeach

                    </ul>
                    <div style="text-align: center">
                        {{ $notifications->links('pagination::frontend') }}
                    </div>
                    @else
                        <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><span>没有消息通知！</span></div>
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection

