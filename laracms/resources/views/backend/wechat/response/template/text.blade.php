@php
    $content = is_json($wechat_response->content) ? json_decode($wechat_response->content) : new \stdClass();
    $text = $content->text ?? '';
@endphp

<div class="form-group">
    <label for="content[text]" class="col-md-2 col-sm-2 control-label">回复文本</label>
    <div class="col-md-5 col-sm-10">
    <textarea class="form-control" rows="4" id="content[text]" name="content[text]"
              data-fv-trigger="blur"
              minlength="1"
    >{{  old('content.text', $text) }}</textarea>
    </div>
</div>