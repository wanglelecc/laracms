<div class="form-group  has-icon-right">
    <label for="{{$key}}" class="col-md-2 col-sm-2 control-label @if($field['required'] ?? false) required @endif ">{{ $field['name'] ?? ''  }}</label>
    <div class="col-md-5 col-sm-10">
        <input type="text" class="form-control {{ $field['attributes']['class'] ?? '' }}" id="{{$key}}" name="{{$key}}" autocomplete="off" placeholder="" value="{{ old($key) }}"
               @if($field['required'] ?? false) required @endif
               data-fv-trigger="blur"
               minlength="{{ $field['attributes']['min'] ?? 0 }}"
               maxlength="{{ $field['attributes']['max'] ?? 255 }}"
        ></div>
</div>