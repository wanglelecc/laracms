<div class="layui-form layui-form-pane">
    <form action="{{ route('replies.store') }}" method="post" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <div class="layui-form-item layui-form-text">
            <a name="comment"></a>
            <div class="layui-input-block">
                <textarea id="L_content" name="content" required lay-verify="required" placeholder="请输入内容"  class="layui-textarea fly-editor" style="height: 150px;"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <input type="hidden" name="jid" value="123">
            <button class="layui-btn" lay-filter="*" type="submit">提交回复</button>
        </div>
    </form>
</div>