@php
    $attributes= is_json($article->attributes) ? json_decode($article->attributes) : new \stdClass();
@endphp
<div class="layui-form-item">
    <label class="layui-form-label">视频ID</label>
    <div class="layui-input-block">
        <input type="text" lay-verify="required" id="attributes[video_id]" name="attributes[video_id]" autocomplete="off" placeholder="视频ID" class="layui-input" value="{{  get_value($attributes, 'video_id', '') }}" />
    </div>
</div>