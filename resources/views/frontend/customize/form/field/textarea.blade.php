<div class="form-group">
    <label for="{{$key}}" class="col-md-2 col-sm-2 control-label @if($field['required'] ?? false) required @endif">{{ $field['name'] ?? '' }}</label>
    <div class="col-md-5 col-sm-10">
        <textarea class="form-control" rows="{{ $field['attributes']['rows'] ?? 4 }}" id="{{ $key }}" name="{{ $key }}"
                  @if($field['required'] ?? false) required @endif
                  data-fv-trigger="blur"
                  minlength="{{ $field['attributes']['min'] ?? 0 }}"
                  maxlength="{{ $field['attributes']['max'] ?? 255 }}"
        >{{ old( $key ) }}</textarea>
    </div>
</div>