@if (isset($errors) && count($errors) > 0)
    {{--<div class="alert alert-danger">--}}
        {{--<h4>有错误发生：</h4>--}}
        {{--<ul>--}}
            {{--@foreach ($errors->all() as $error)--}}
                {{--<li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}

    <script>layer.alert('@foreach ($errors->all() as $error) {{ $error }} <br /> @endforeach', {icon: 2,time:3000});</script>
@endif