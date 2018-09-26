@if (Session::has('message'))
    {{--<div class="alert alert-info">--}}
        {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
        {{--{{ Session::get('message') }}--}}
    {{--</div>--}}

    <script>layer.alert('{{ Session::get('message') }}', {icon: 4,time:3000});</script>
@endif

@if (Session::has('success'))
    {{--<div class="alert alert-success">--}}
        {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
        {{--{{ Session::get('success') }}--}}
    {{--</div>--}}

    <script>layer.alert('{{ Session::get('success') }}', {icon: 1,time:2000});</script>
@endif

@if (Session::has('danger'))
    {{--<div class="alert alert-danger">--}}
        {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
        {{--{{ Session::get('danger') }}--}}
    {{--</div>--}}

    <script>layer.alert('{{ Session::get('danger') }}', {icon: 3,time:3000});</script>
@endif