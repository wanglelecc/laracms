@php
$data = is_json($wechat_menu->data) ? json_decode($wechat_menu->data) : new \stdClass();
$link = $data->link ?? '';
@endphp
<div class="form-group has-feedback has-icon-right">
    <label for="data[link]" class="col-md-2 col-sm-2 control-label required">跳转URL</label>
    <div class="col-md-5 col-sm-10">
    <input type="url" class="form-control" id="data[link]" name="data[link]" autocomplete="off" placeholder="" value="{{ old('data.link',$link) }}"
           required
           data-fv-trigger="blur"
           minlength="1"
           maxlength="128"
    ></div>
</div>