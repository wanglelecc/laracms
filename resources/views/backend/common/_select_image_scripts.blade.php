<script type="text/javascript">
    layui.use(['layer'], function(){
        $("{{$elem}}").click(function(){
            layer.open({
                type: 2,
                title: '选择图片',
                skin: 'layui-layer-rim', //加上边框
                area: ['1222px', '660px'], //宽高
                content: '{{ route('media.upload.image') }}'
                ,btn: ['确定选择', '关闭'] //只是为了演示
                ,yes: function(){

                }
                ,btn2: function(){
                    layer.closeAll();
                }
            });

            return false;
        });

    });
</script>