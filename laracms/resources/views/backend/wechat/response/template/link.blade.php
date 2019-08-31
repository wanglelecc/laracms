@php
$content = is_json($wechat_response->content) ? json_decode($wechat_response->content) : new \stdClass();
$link = $content->link ?? '';
@endphp
<div class="form-group has-feedback has-icon-right">
    <label for="content[link]" class="col-md-2 col-sm-2 control-label required">跳转URL</label>
    <div class="col-md-5 col-sm-10">
    <input type="text" class="form-control" id="content[link]" name="content[link]" autocomplete="off" placeholder="" value="{{ old('content.link',$link) }}"
           required
           data-fv-trigger="blur"
           minlength="1"
           maxlength="128"
    ></div>
</div>