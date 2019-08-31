@if (count($errors) > 0)
    <div class="alert with-icon alert-danger alert-dismissable">
        <i class="icon-remove-sign"></i>
        <div class="content">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif