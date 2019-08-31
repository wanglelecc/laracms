@extends('frontend::layouts.app')

@section('title', $title = $form['title'])
@section('description', $form['description'] ?? config('system.common.basic.description',''))
@section('keywords', $form['keywords'] ?? config('system.common.basic.keywords',''))

@section('breadcrumb')
    <a><cite>{{$title}}</cite></a>
@endsection

@section('content')
    <div class="layui-container">
          <div class="layui-row layui-col-space15">
            <div class="layui-col-md12 content detail">

                <div class="fly-panel">
                    <h1>{{$form['title'] }}</h1>

                    <div class="layui-text">
                           <form id="form-validator" class="form-horizontal" method="POST" action="{{ route('form.store', $form['form']) }}?redirect={{ previous_url() }}">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <input type="hidden" name="type" value="{{ $form['form'] }}" />

                            @foreach($form['field'] as $key => $field)
                                @include('frontend::form.field.'.strtolower($field['type']),[ 'key' => $key, 'field' => $field, ])
                            @endforeach

                            @includeWhen($form['verification'], 'frontend::form.field.captcha')

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-5 col-sm-10">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                    <button type="reset" class="btn btn-default">重置</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/laracms/plugins/zui/css/zui.min.css')}}">
@endsection

@section('scripts')
@endsection