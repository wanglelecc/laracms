@php
    $data = is_json($wechat_menu->data) ? json_decode($wechat_menu->data) : new \stdClass();
    $media_id = $data->media_id ?? '';
@endphp
<div class="form-group has-feedback has-icon-right">
    <label for="data[media_id]" class="col-md-2 col-sm-2 control-label required">图文素材</label>
    <div class="col-md-5 col-sm-10">
    <input type="text" class="form-control" id="data[media_id]" name="data[media_id]" autocomplete="off" placeholder="" value="{{ old('data.media_id',$media_id) }}"
           required
           data-fv-trigger="blur"
           minlength="1"
           maxlength="128"
    ></div>
</div>