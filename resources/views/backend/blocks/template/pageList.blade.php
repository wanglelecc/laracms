@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
@endphp
<div class="layui-form-item">
    <label class="layui-form-label">显示数量</label>
    <div class="layui-input-block">
        <input type="number" lay-verify="required" id="content[display]" name="content[display]" autocomplete="off" placeholder="显示数量" class="layui-input" value="{{  get_value($content, 'display', 10) }}" />
    </div>
</div>