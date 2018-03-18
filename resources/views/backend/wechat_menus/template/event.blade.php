@php
    $data = is_json($wechat_menu->data) ? json_decode($wechat_menu->data) : new \stdClass();
    $event = $data->event ?? '';
@endphp
<div class="layui-form-item">
    <label class="layui-form-label" for="data-link-field">自定义事件</label>
    <div class="layui-input-block">
        <input type="text" name="data[event]" id="data-link-field" lay-verify="required" required autocomplete="off" placeholder="请输入自定义事件方法名" class="layui-input" value="{{ old('data.event',$event) }}" >
    </div>
</div>