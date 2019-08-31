<div class="form-group has-feedback  has-icon-right">
    <label for="content" class="col-md-2 col-sm-2 control-label required">网站头部</label>
    <div class="col-md-5 col-sm-10">
    <textarea name="content" id="content"  rows='6' data-mode='html' data-height='400'  placeholder="" class="form-control codeeditor">{{  old('content', $block->content) }}</textarea>
    </div>
</div>