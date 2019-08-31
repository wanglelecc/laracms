@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
    $mark = get_value($content, 'mark', 0);
@endphp
<div class="form-group has-feedback  has-icon-right">
    <label for="content[mark]" class="col-md-2 col-sm-2 control-label required">幻灯片标识</label>
    <div class="col-md-5 col-sm-10">
    <select name="content[mark]" class="form-control">
        <option value=""></option>
        @foreach(config('slides') as $item)
            <option @if($mark == $item['id']) selected @endif value="{{$item['id']}}">{{$item['name']}}</option>
        @endforeach
    </select>
    </div>
</div>