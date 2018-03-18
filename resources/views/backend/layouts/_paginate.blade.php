<script>
    layui.use(['laypage', 'layer'], function(){
        var laypage = layui.laypage
            ,layer = layui.layer;
        laypage.render({
            elem: 'paginate-render'
            ,limit: {{ config('administrator.paginate.limit') }}
            ,curr: window.jsUrlHelper.getUrlParam(window.location.href.toString(), 'page')
            ,count: {{ $count }} //数据总数
            ,jump: function(obj, first){
                if(!first){
                    var nUrl = window.jsUrlHelper.putUrlParam( window.location.href.toString(), 'page', obj.curr);
                    nUrl = window.jsUrlHelper.putUrlParam( nUrl, 'limit', obj.limit);
                    window.location.href = nUrl;
                }
            }
        });

        $(".form-delete").click(function(){

            var tUrl = $(this).attr('data-url');

            layer.confirm('确认删除吗？', {
                btn: ['确认', '取消']
            }, function(index){
                $("#delete-form").attr("action",tUrl).submit();
                console.log(tUrl);
                layer.close(index);
                return false;
            }, function(index){
                layer.close(index);
                return true;
            });

            return false;
        });
    });
</script>