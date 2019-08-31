@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
    $page_ids = get_value($content, 'page_id', []);

    $page = app(\Wanglelecc\Laracms\Models\Page::class);
    $pages = $page->where('type','=','page')->orderBy('order', 'desc')->orderBy('id','desc')->get()->pluck('title', 'id')->toArray();
@endphp

<div class="form-group has-feedback  has-icon-right">
    <label for="content[article_id][]" class="col-md-2 col-sm-2 control-label required">页面列表</label>
    <div class="col-md-5 col-sm-10">
        <select name="content[page_id][]" id="content[article_id][]" data-placeholder="选择页面." class="chosen-select form-control" tabindex="2" multiple="">
            @foreach($pages as $key => $value)
                <option @if(in_array($key, $page_ids) ) selected @endif value="{{$key}}">{{$value}}</option>
            @endforeach
        </select>
    </div>
</div>