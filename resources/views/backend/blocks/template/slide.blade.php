@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
    $mark = get_value($content, 'mark', 0);
@endphp

<div class="layui-form-item">
    <label class="layui-form-label">幻灯片标识</label>
    <div class="layui-input-block">
        <select name="content[mark]">
            <option value=""></option>
            @foreach(config('slides') as $item)
                <option @if($mark == $item['id']) selected @endif value="{{$item['id']}}">{{$item['name']}}</option>
            @endforeach
        </select>
    </div>
</div>