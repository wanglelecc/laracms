@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
@endphp
<div class="layui-form-item">
    <label class="layui-form-label">类别</label>
    <div class="layui-input-block">
        <input type="text" lay-verify="required" id="content[type]" name="content[type]" autocomplete="off" placeholder="类别" class="layui-input" value="{{  get_value($content, 'type', '') }}" />
    </div>
</div>