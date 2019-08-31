@php
    $data = is_json($wechat_menu->data) ? json_decode($wechat_menu->data) : new \stdClass();
    $type = $data->type ?? 'article';
    $category_id = $data->category_id ?? 0;
    $category_name = $data->category_name ?? '';
    $limit = $data->limit ?? 8;

    $categoryHandler = app(\Wanglelecc\Laracms\Handlers\CategoryHandler::class);
    $category = $categoryHandler->select($categoryHandler->getCategorys('article'));
@endphp
<div class="form-group has-feedback has-icon-right">
    <label for="data[event]" class="col-md-2 col-sm-2 control-label required">内容分类</label>
    <div class="col-md-5 col-sm-10">
        <input type="hidden" name="data[type]" value="{{$type}}" />
        <input type="hidden" name="data[category_name]" id="wechat_menu_content_category_name" value="{{$category_name}}" />
        <select name="data[category_id]" class="form-control _chosen-select "  tabindex="2" id="wechat_menu_content_category_id">
            <option value=""></option>
            @foreach($category as $key => $value)
                <option @if($category_id == $key) selected @endif value="{{$key}}" data-title="{{$value}}">{{$value}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group has-feedback  has-icon-right">
    <label for="data[limit]" class="col-md-2 col-sm-2 control-label required">数量</label>
    <div class="col-md-5 col-sm-10">
    <input type="number" class="form-control" id="data[limit]" name="content[limit]" autocomplete="off" placeholder="" value="{{ old('data.limit',$limit) }}"
           required
           data-fv-trigger="blur"
           min="1"
           max="8"
    ></div>
</div>