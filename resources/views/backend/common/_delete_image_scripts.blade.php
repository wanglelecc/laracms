<script type="text/javascript">
    layui.use(['layer'], function(){
        $("{{$elem}}").click(function(){
            layer.confirm('确认删除吗？', {
                btn: ['确认', '取消']
            }, function(index){
                $("{{$fieldElem}}").val('');
                $("{{$previewElem}}").attr("src",'/images/pic-none.png');
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