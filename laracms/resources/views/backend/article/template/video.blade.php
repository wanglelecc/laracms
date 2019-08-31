@php
    $attribute = is_json($article->attribute) ? json_decode($article->attribute) : new \stdClass();
@endphp


<div class="form-group has-feedback  has-icon-right">
    <label class="col-md-2 col-sm-2 control-label">视频</label>
    <div class="col-md-5 col-sm-10">
        <div class="panel">
            <div class="panel-body">
                <h4 id="video_title_h4">{{ get_value($attribute, 'video_title', '') }}</h4>
                <img src="{{ get_value($attribute, 'video_thumb', storage_video_url(null)) }}" id="video_thumb_image" class="img-rounded" width="260px" height="200px" alt="">
                <input id="upload_video_id" type="hidden" name="attribute[video_id]" value="{{ get_value($attribute, 'video_id', '') }}" >
                <input id="upload_video_thumb" type="hidden" name="attribute[video_thumb]" value="{{ get_value($attribute, 'video_thumb', '') }}" >
                <input id="upload_video_title" type="hidden" name="attribute[video_title]" value="{{ get_value($attribute, 'video_title', '') }}" >
                <button id="upload_video" type="button" class="btn btn-info uploader-btn-browse"><i class="icon icon-upload"></i> 上传</button>
                <button id="select_video" type="button" class="btn btn-primary"><i class="icon icon-file-image"></i> 选择</button>
                <button id="delete_video" type="button" class="btn btn-danger"><i class="icon icon-remove-sign"></i> 删除</button>
            </div>
        </div>
    </div>
</div>