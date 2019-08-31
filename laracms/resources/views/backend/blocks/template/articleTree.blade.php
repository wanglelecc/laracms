@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
    $category_id = get_value($content, 'category_id', 0);

    $categoryHandler = app(\Wanglelecc\Laracms\Handlers\CategoryHandler::class);
    $category = $categoryHandler->select($categoryHandler->getCategorys('article'));
@endphp
<div class="form-group has-feedback  has-icon-right">
    <label for="content[category_id]" class="col-md-2 col-sm-2 control-label required">文章分类</label>
    <div class="col-md-5 col-sm-10">
        <select name="content[category_id]" class="form-control">
            <option value="0">/</option>
            @foreach($category as $key => $value)
                <option @if($category_id == $key) selected @endif value="{{$key}}">/ {{$value}}</option>
            @endforeach
        </select>
    </div>
</div>