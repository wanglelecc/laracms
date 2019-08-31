@php
    $data = is_json($wechat_menu->data) ? json_decode($wechat_menu->data) : new \stdClass();
    $text = $data->text ?? '';
@endphp
<div class="form-group">
    <label for="data[text]" class="col-md-2 col-sm-2 control-label">回复文本</label>
    <div class="col-md-5 col-sm-10">
    <textarea class="form-control" rows="4" id="data[text]" name="data[text]"
              data-fv-trigger="blur"
              minlength="1"
    >{{ old('data.text', $text) }}</textarea>
    </div>
</div>