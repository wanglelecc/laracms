<div class="form-group has-feedback  has-icon-right">
    <label for="content" class="col-md-2 col-sm-2 control-label required">HTML 代码</label>
    <div class="col-md-5 col-sm-10">
    <textarea name="content" id="content" rows='18' mode='html' class="form-control codeeditor">{{  old('content', $block->content) }}</textarea>
    </div>
</div>