<div class="form-group has-feedback has-icon-right">
    <label for="" class="col-md-2 col-sm-2 control-label @if($field['required'] ?? false) required @endif">{{ $field['name'] ?? '' }}</label>
    <div class="col-md-5 col-sm-10">
        <div class="checkbox">
            @foreach($field['options'] as $k => $v)
            <label class="checkbox-inline">
                    <input type="checkbox" name="{{$key}}[]" value="{{ $k }}" title="{{ $k }}" @if(in_array($k, ($field['default'] ?? [])) || in_array($k, old($key,[]))) checked="checked" @endif  > {{$v}}
            </label>
            @endforeach
        </div></div>
</div>