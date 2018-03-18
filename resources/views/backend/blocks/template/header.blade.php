<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">网站头部</label>
    <div class="layui-input-block">
        <textarea name="content" lay-verify="" id="content"  rows=20 data-mode='html' data-height='400'  placeholder="网站头部" class="layui-textarea codeeditor">{{  old('content', $block->content) }}</textarea>
    </div>
</div>