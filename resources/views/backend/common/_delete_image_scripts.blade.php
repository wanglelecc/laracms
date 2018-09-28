<script type="text/javascript">
$("{{$elem}}").click(function(){
    bootbox.confirm({
        size: "small",
        title: "系统提示",
        message: "确认删除吗？",
        callback: function(result){ if(result === true){
            $("{{$fieldElem}}").val('');
            $("{{$previewElem}}").attr("src",'/images/pic-none.png');
        } }
    });

    return false;
});
</script>