<div class="form-group has-feedback has-icon-right">
    <label for="" class="col-md-2 col-sm-2 control-label @if($field['required'] ?? false) required @endif">{{ $field['name'] ?? '' }}</label>
    <div class="col-md-5 col-sm-10">
        <div class="radio">
            @foreach($field['options'] as $k => $v)
            <label class="radio-inline">
                <input type="radio" name="{{$key}}" value="{{ $k }}" @if( ($field['default'] ?? null) == $k || $k == old($key, null) ) checked="" @endif @if($field['required'] ?? false) required @endif > {{$v}}
            </label>
            @endforeach
        </div>
    </div>
</div>