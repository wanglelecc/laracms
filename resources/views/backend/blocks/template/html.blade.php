<div class="form-group has-feedback  has-icon-right">
    <label for="content" class="col-md-2 col-sm-2 control-label required">内容</label>
    <div class="col-md-5 col-sm-10">
    <textarea name="content" id="content" placeholder="内容" class="form-control editor">{{  old('content', $block->content) }}</textarea>
    </div>
</div>