@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
@endphp
<div class="form-group has-feedback  has-icon-right">
    <label for="content[display]" class="col-md-2 col-sm-2 control-label required">显示数量</label>
    <div class="col-md-5 col-sm-10">
    <input type="number" id="content[display]" name="content[display]" autocomplete="off" placeholder="" class="form-control" value="{{  get_value($content, 'display', 10) }}"
           required
           data-fv-trigger="blur"
           min="1"
           max="100"
    ></div>
</div>