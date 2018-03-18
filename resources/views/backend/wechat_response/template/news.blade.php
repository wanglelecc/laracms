@php
    $content = is_json($wechat_response->content) ? json_decode($wechat_response->content) : new \stdClass();
    $type = $content->type ?? 'article';
    $category_id = $content->category_id ?? 0;
    $category_name = $content->category_name ?? '';
    $limit = $content->limit ?? 8;

    $categoryHandler = app(\App\Handlers\CategoryHandler::class);
    $category = $categoryHandler->select($categoryHandler->getCategorys('article'));
@endphp
<div class="layui-form-item">
    <label class="layui-form-label" for="data-link-field">类容分类</label>
    <div class="layui-input-block">
        <input type="hidden" name="content[type]" value="{{$type}}" />
        <input type="hidden" name="content[category_name]" id="wechat_response_content_category_name" value="{{$category_name}}" />
        <select name="content[category_id]"  lay-filter="wechat_response_content_category_id">
            <option value=""></option>
            @foreach($category as $key => $value)
                <option @if($category_id == $key) selected @endif value="{{$key}}" data-title="{{$value}}">{{$value}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label" for="data-link-field">数量</label>
    <div class="layui-input-block">
        <input type="number" name="content[limit]" id="data-link-field" lay-verify="required" maxlength="8" required autocomplete="off" placeholder="请输入自定义事件方法名" class="layui-input" value="{{ old('content.limit',$limit) }}" >
    </div>
</div>