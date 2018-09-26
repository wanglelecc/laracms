@php
    $attribute = is_json($article->attribute) ? json_decode($article->attribute) : new \stdClass();
@endphp

<div class="form-group has-feedback has-icon-right">
    <label for="attribute[video_id]" class="col-md-2 col-sm-2 control-label">视频ID</label>
    <div class="col-md-5 col-sm-10">
    <input id="attribute[video_id]" type="text" name="attribute[video_id]" autocomplete="off" class="form-control" value="{{  get_value($attribute, 'video_id', '') }}"
           required
           data-fv-trigger="blur"
           minlength="1"
           maxlength="64"
    ></div>
</div>