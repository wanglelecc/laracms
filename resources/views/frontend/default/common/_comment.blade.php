<div class="fly-panel detail-box" id="flyReply">
    <fieldset class="layui-elem-field layui-field-title" style="text-align: center;"> <legend>回帖</legend> </fieldset>
    <ul class="jieda" id="jieda">
        <li class="fly-none">消灭零回复</li>
    </ul>
    <div style="text-align: center"> </div> <a name="comment"> </a>

    <div class="layui-form layui-form-pane">
        <form action="/jie/reply/" method="post">
            <div class="layui-form-item layui-form-text">
                <div class="layui-input-block">
                    <div class="layui-unselect fly-edit">
                        <span type="face" title="表情"><i class="iconfont icon-yxj-expression" style="top: 1px;"></i></span>
                        <span type="picture" title="图片：img[src]"><i class="iconfont icon-tupian"></i></span>
                        <span type="href" title="超链接格式：a(href)[text]"><i class="iconfont icon-lianjie"></i></span>
                        <span type="quote" title="引用"><i class="iconfont icon-yinyong" style="top: 1px;"></i></span>
                        <span type="code" title="插入代码" class="layui-hide-xs"><i class="iconfont icon-emwdaima" style="top: 1px;"></i></span>
                        <span type="hr" title="水平线">hr</span>
                        <span type="preview" title="预览"><i class="iconfont icon-yulan1"></i></span>
                    </div>
                    <textarea id="L_content" name="content" required="" lay-verify="required" placeholder="请输入内容" class="layui-textarea fly-editor" style="height: 150px;"></textarea> </div> </div> <div class="layui-form-item"> <input type="hidden" name="jid" value="22739">
                <input type="hidden" name="daPages" value="0">
                <button class="layui-btn" lay-filter="*" lay-submit="">提交回复</button>
            </div>
        </form>
    </div>
</div>