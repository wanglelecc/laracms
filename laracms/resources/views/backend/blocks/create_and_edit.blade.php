@extends('backend::layouts.app')

@section('title', $title = $block->id ? '编辑区块' : '添加区块' )

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">区块管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $block->id ? route('blocks.update', $block->id) : route('blocks.store') }}?redirect={{ previous_url() }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="{{ $block->id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="type" class="col-md-2 col-sm-2 control-label required">类型</label>
                            <div class="col-md-5 col-sm-10">
                                @if($block->id)
                                    <input type="hidden" name="type" value="{{$block->type}}" />
                                    <input type="text"  class="form-control" disabled value="{{ config('blocks.types.'.$block->type)}}">
                                @else
                                    <select name="type" class="form-control" id="block_type">
                                        <option value=""></option>
                                        @foreach(config('blocks.types') as $key => $value)
                                            <option @if($type == $key) selected @endif value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="title" id="title" autocomplete="off" placeholder="" class="form-control" value="{{ old('title',$block->title) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="more_title" class="col-md-2 col-sm-2 control-label">更多文字</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="more_title" autocomplete="off" placeholder="" class="form-control" value="{{ old('more_title',$block->more_title) }}"
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="more_link" class="col-md-2 col-sm-2 control-label">更多地址</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="url" name="more_link" autocomplete="off" placeholder="" class="form-control" value="{{ old('more_link',$block->more_link) }}"
                                       data-fv-trigger="blur"
                                       minlength="1"
                                       maxlength="128"
                                >
                            </div>
                        </div>

                        @if($type)
                            @include('backend::blocks.template.'.$type,['block' => $block])
                        @endif

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
    @include('backend::common._code_editor_styles')
@stop

@section('scripts')
    <script type="text/javascript">
        $('#block_type').bind('change',function(){
            var val = $("#block_type").val();
            var nUrl = window.helper.putUrlParam( window.location.href.toString(), 'type', val);
            window.location.href = nUrl;
        });
    </script>

    @include('backend::common._editor_scripts',['folder'=>'block'])
    @include('backend::common._code_editor_scripts',['folder'=>'block'])
@endsection