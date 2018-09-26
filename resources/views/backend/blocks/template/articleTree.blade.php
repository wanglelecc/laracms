@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
@endphp
<div class="form-group has-feedback  has-icon-right">
    <label for="content[type]" class="col-md-2 col-sm-2 control-label required">类别</label>
    <div class="col-md-5 col-sm-10">
    <input type="text" id="content[type]" name="content[type]" autocomplete="off" placeholder="" class="form-control" value="{{  get_value($content, 'type', '') }}"
           required
           data-fv-trigger="blur"
    /></div>
</div>