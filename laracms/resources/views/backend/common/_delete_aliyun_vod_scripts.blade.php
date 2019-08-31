<script type="text/javascript">
$("{{$elem}}").click(function(){
    bootbox.confirm({
        size: "small",
        title: "系统提示",
        message: "确认删除吗？",
        callback: function(result){ if(result === true){

            $("{{$fieldImageElem}}").attr("src",'/images/video-none.png');
            $("{{$previewElem}}").val('');
            $("{{$fieldIdElem}}").val('');
            $("{{$fieldTitleElem}}").val('');
            $("{{$fieldThumbElem}}").val('');
            $("{{$previewElem}}").html('');

        } }
    });

    return false;
});
</script>