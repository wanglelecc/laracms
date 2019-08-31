@extends('backend::layouts.app')

@section('title', $title = $structure['title'])

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li>{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST" action="">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}

                        @foreach($structure['field'] as $key => $field)
                            <div class="form-group has-feedback  has-icon-right">
                                <label for="type" class="col-md-2 col-sm-2 control-label">{{ $field['name'] }}</label>
                                <div class="col-md-5 col-sm-10">
                                    <input type="text"  class="form-control" disabled value="{{ get_form_value($form->$key, $field) }}">
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="type" class="col-md-2 col-sm-2 control-label">用户</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="text"  class="form-control" disabled value="{{$form->user->name ?? '匿名'}}">
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="type" class="col-md-2 col-sm-2 control-label">IP</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="text"  class="form-control" disabled value="{{$form->ip}}">
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="type" class="col-md-2 col-sm-2 control-label">地址</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="text"  class="form-control" disabled value="{{$form->location}}">
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="type" class="col-md-2 col-sm-2 control-label">时间</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="text"  class="form-control" disabled value="{{$form->created_at}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5 col-sm-10">
                                <a href="{{ url()->previous() }}" class="btn btn-default">返回</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection