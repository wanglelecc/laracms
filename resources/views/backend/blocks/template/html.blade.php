<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">内容</label>
    <div class="layui-input-block">
        <textarea name="content" lay-verify="" id="content" placeholder="内容" class="layui-textarea editor">{{  old('content', $block->content) }}</textarea>
    </div>
</div>