@php
    $content = is_json($wechat_response->content) ? json_decode($wechat_response->content) : new \stdClass();
    $text = $content->text ?? '';
@endphp
<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">回复文本</label>
    <div class="layui-input-block">
        <textarea name="content[text]" lay-verify="required" placeholder="回复文本" class="layui-textarea">{{  old('content.text', $text) }}</textarea>
    </div>
</div>