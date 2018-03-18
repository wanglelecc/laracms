<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">HTML 代码</label>
    <div class="layui-input-block">
        <textarea name="content" lay-verify="" id="content"  rows=20 data-mode='html' data-height='400'  placeholder="HTML" class="layui-textarea codeeditor">{{  old('content', $block->content) }}</textarea>
    </div>
</div>