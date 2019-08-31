@php
    $content = is_json($wechat_response->content) ? json_decode($wechat_response->content) : new \stdClass();
    $type = $content->type ?? 'article';
    $category_id = $content->category_id ?? 0;
    $category_name = $content->category_name ?? '';
    $limit = $content->limit ?? 8;

    $categoryHandler = app(\Wanglelecc\Laracms\Handlers\CategoryHandler::class);
    $category = $categoryHandler->select($categoryHandler->getCategorys('article'));
@endphp

<div class="form-group has-feedback  has-icon-right">
    <label for="" class="col-md-2 col-sm-2 control-label required">类容分类</label>
    <div class="col-md-5 col-sm-10">
    <input type="hidden" name="content[category_name]" value="{{$type}}" id="wechat_response_news_category_name" />
    <select data-placeholder="请选择类容分类" class="_chosen-select form-control"  tabindex="2" id="wechat_response_news_category_id" name="content[category_id]">
        <option value=""></option>
        @foreach($category as $key => $value)
            <option @if($category_id == $key) selected @endif value="{{$key}}" data-title="{{$value}}">{{$value}}</option>
        @endforeach
    </select>
    </div>
</div>

<div class="form-group has-feedback  has-icon-right">
    <label for="content[limit]" class="col-md-2 col-sm-2 control-label required">数量</label>
    <div class="col-md-5 col-sm-10">
    <input type="number" class="form-control" id="content[limit]" name="content[limit]" autocomplete="off" placeholder="" value="{{ old('content.limit',$limit) }}"
           required
           data-fv-trigger="blur"
           min="1"
           max="100"
    ></div>
</div>