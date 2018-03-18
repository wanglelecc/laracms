@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
    $category_id = get_value($content, 'category_id', 0);

    $categoryHandler = app(\App\Handlers\CategoryHandler::class);
    $category = $categoryHandler->select($categoryHandler->getCategorys('article'));
@endphp

<div class="layui-form-item">
    <label class="layui-form-label">文章分类</label>
    <div class="layui-input-block">
        <select name="content[category_id]">
            <option value=""></option>
            @foreach($category as $key => $value)
                <option @if($category_id == $key) selected @endif value="{{$key}}">{{$value}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">显示数量</label>
    <div class="layui-input-block">
        <input type="number" lay-verify="required" id="content[display]" name="content[display]" autocomplete="off" placeholder="显示数量" class="layui-input" value="{{  get_value($content, 'display', 10) }}" />
    </div>
</div>