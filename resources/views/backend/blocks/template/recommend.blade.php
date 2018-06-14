@php
    $content = is_json($block->content) ? json_decode($block->content) : new \stdClass();
    $article_ids = get_value($content, 'article_id', []);

    $article = app(\App\Models\Article::class);
    $articles = $article->where('type','<>','page')->orderBy('order', 'desc')->orderBy('id','desc')->get()->pluck('title', 'id')->toArray();
@endphp

<div class="layui-form-item">
    <label class="layui-form-label">推荐内容</label>
    <div id="block-items">

        @if($article_ids)
            @foreach($article_ids as $article_id)
            <div class="layui-input-block">
                <div class="layui-input-inline">
                <select name="content[article_id][]">
                    <option value=""></option>
                    @foreach($articles as $key => $value)
                        <option @if($article_id == $key) selected @endif value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
                </div>
                <button type="button" class="layui-btn layui-btn-danger block-item-delete"><i class="layui-icon"></i></button>
                <br />
                <br />
            </div>
            @endforeach
        @else
        <div class="layui-input-block">
            <div class="layui-input-inline">
                <select name="content[article_id][]">
                    <option value=""></option>
                    @foreach($articles as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="layui-btn layui-btn-danger block-item-delete"><i class="layui-icon"></i></button>
            <br />
            <br />
        </div>
        @endif
    </div>

    <div class="layui-input-block">
        <div class="layui-input-inline">
            <button id="block-item-add" type="button" class="layui-btn layui-btn-normal layui-btn-fluid">添加一项</button>
        </div>
    </div>
</div>

@section('styles')
    <style>
        #block-items .layui-input-inline, #block-item-add{ width:390px; }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript">
        layui.use(['upload','form', 'layer'], function(){
            var form = layui.form;
            var upload = layui.upload;

            // 添加选项
            $("#block-item-add").click(function(){

                var len = $("#block-items .layui-input-block").length;
                if(len >= 10){
                    layer.alert("已达上限！");
                    return false;
                }

                $("#block-items").append("<div class=\"layui-input-block\">\n" +
                    "            <div class=\"layui-input-inline\">\n" +
                    "            <select name=\"content[article_id][]\">\n" +
                    "                <option value=\"\"></option>\n" +
                    "                @foreach($articles as $key => $value)\n" +
                    "                    <option value=\"{{$key}}\">{{$value}}</option>\n" +
                    "                @endforeach\n" +
                    "            </select>\n" +
                    "            </div>\n" +
                    "            <button type=\"button\" class=\"layui-btn layui-btn-danger block-item-delete\"><i class=\"layui-icon\"></i></button>\n" +
                    "            <br />\n" +
                    "            <br />\n" +
                    "        </div>");

                form.render();
            });

            // 删除当前项
            $("#block-items").delegate(".block-item-delete","click",function(){
                var len = $("#block-items .layui-input-block").length;
                if(len <= 1){
                    layer.alert("至少保留一个呦！");
                    return false;
                }

                $(this).parent().remove();

                form.render();
            });

        });
    </script>
@endsection