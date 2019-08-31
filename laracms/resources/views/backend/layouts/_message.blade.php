@if (Session::has('message'))
    <div class="alert with-icon alert-info">
        <i class="icon-info-sign"></i>
        <div class="content">{{ Session::get('message') }}</div>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif
@if (Session::has('success'))
    <div class="alert with-icon alert-success">
        <i class="icon-ok-sign"></i>
        <div class="content">{{ Session::get('success') }}</div>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif
@if (Session::has('warning'))
    <div class="alert with-icon alert-warning">
        <i class="icon-frown"></i>
        <div class="content">{{ Session::get('warning') }}</div>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif
@if (Session::has('danger'))
    <div class="alert with-icon alert-danger">
        <i class="icon-remove-sign"></i>
        <div class="content">{{ Session::get('danger') }}</div>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif