@php
$content = is_json($wechat_response->content) ? json_decode($wechat_response->content) : new \stdClass();
$link = $content->link ?? '';
@endphp
<div class="layui-form-item">
    <label class="layui-form-label" for="data-link-field">跳转URL</label>
    <div class="layui-input-block">
        <input type="url" name="content[link]" id="data-link-field" lay-verify="required" required autocomplete="off" placeholder="请输入url" class="layui-input" value="{{ old('content.link',$link) }}" >
    </div>
</div>