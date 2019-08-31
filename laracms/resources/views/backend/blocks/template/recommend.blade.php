@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
    $article_ids = get_value($content, 'article_id', []);

    $article = app(\Wanglelecc\Laracms\Models\Article::class);
    $articles = $article->where('type','<>','page')->orderBy('order', 'desc')->orderBy('id','desc')->get()->pluck('title', 'id')->toArray();
@endphp

<div class="form-group has-feedback  has-icon-right">
    <label for="content[article_id][]" class="col-md-2 col-sm-2 control-label required">推荐内容</label>
    <div class="col-md-5 col-sm-10">
    <select name="content[article_id][]" id="content[article_id][]" data-placeholder="选择推荐内容." class="chosen-select form-control" tabindex="2" multiple="">
        @foreach($articles as $key => $value)
            <option @if(in_array($key, $article_ids) ) selected @endif value="{{$key}}">{{$value}}</option>
        @endforeach
    </select>
    </div>
</div>