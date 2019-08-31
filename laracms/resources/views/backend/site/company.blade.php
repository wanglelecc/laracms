@extends('backend::layouts.app')

@section('title', $title = '公司信息' )

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{route('administrator.site.company')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="POST">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">公司名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="" value="{{ get_value($site, 'name') }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="64"
                            ></div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-2 col-sm-2 control-label">公司简介</label>
                            <div class="col-md-5 col-sm-10">
                            <textarea class="form-control" rows="6" id="description" name="description"
                                      data-fv-trigger="blur"
                                      minlength="1"
                            >{{ get_value($site, 'description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="col-md-2 col-sm-2 control-label">公司介绍</label>
                            <div class="col-md-8 col-sm-10">
                            <textarea class="form-control editor" rows="6" id="content" name="content"
                                      data-fv-trigger="blur"
                                      minlength="1"
                            >{{ get_value($site, 'content') }}</textarea>
                            </div>
                        </div>

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
@endsection


@section('styles')
    @include('backend::common._editor_styles')
@stop

@section('scripts')
    @include('backend::common._editor_scripts',['folder'=>'company'])
@stop