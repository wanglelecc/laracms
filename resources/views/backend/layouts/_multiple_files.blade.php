{{--<script src="{{asset('plugins/sortable/Sortable.min.js')}}" type="text/javascript"></script>--}}
<script>
    {{--layui.use(['laypage', 'layer', 'upload','form'], function(){--}}

        {{--var form = layui.form;--}}
        {{--var upload = layui.upload;--}}
        {{--var tId = 0;--}}

        {{--$(".form-multiple-files").click(function(){--}}

            {{--var tUrl = $(this).attr('data-url');--}}
            {{--tId = $(this).attr('data-id');--}}

            {{--var loaddingIndex = layer.load(2, {time : 20 * 1000});--}}
            {{--$.ajax({--}}
                {{--type: 'get',--}}
                {{--url: tUrl,--}}
                {{--dataType: "json",--}}
                {{--success: function(data) {--}}

                    {{--var _openContentHtml = '';--}}
                    {{--if(data){--}}

                        {{--for(var i = 0; i < data.length; i++){--}}
                            {{--_openContentHtml += '\t\t<div class="sortable-item">\n' +--}}
                                {{--'\t\t  <div class="block-multiple-files-item"><input type="hidden" name="multiple_files[]" value="'+data[i].path +'" /><img src="'+data[i].url+'" /></div>\n' +--}}
                                {{--'\t\t<a href="javascript:;" class="sortable-item-delete">删除</a></div>\n';--}}
                        {{--}--}}
                    {{--}--}}

                    {{--layer.close(loaddingIndex);--}}

                    {{--var openContentHtml = '<div class="block-multiple-files">\n' +--}}
                        {{--'\t<button type="button" class="layui-btn" id="block-multiple-files-upload"><i class="layui-icon"></i> 选择文件</button>\n' +--}}
                        {{--'\t<div class="layui-inline layui-word-aux">文件大小不超过 2MB.</div>\n' +--}}
                        {{--'\t<br /><br />\n' +--}}
                        {{--'\t<form method="post" id="form-multiple-files"><div class="" id="sortable-items">\n';--}}

                    {{--openContentHtml += _openContentHtml;--}}

                    {{--openContentHtml += '\t</div></form>\n' + '</div>';--}}

                    {{--layer.open({--}}
                        {{--type: 1,--}}
                        {{--skin: 'layui-layer-rim', //加上边框--}}
                        {{--area: ['660px','695px'], //宽高--}}
                        {{--shadeClose: true, //开启遮罩关闭--}}
                        {{--title : '多图',--}}
                        {{--btn: ['保存','取消'], //按钮--}}
                        {{--closeBtn: 1,--}}
                        {{--btnAlign:'c',--}}
                        {{--scrollbar: false,--}}
                        {{--content: openContentHtml,--}}
                        {{--yes: function(index, layero){--}}
                            {{--loaddingIndex = layer.load(2, {time: 20 * 1000});--}}

                            {{--// console.log($("#form-multiple-files").serialize());--}}

                            {{--$.ajax({--}}
                                {{--type: 'post',--}}
                                {{--url: tUrl,--}}
                                {{--data: $("#form-multiple-files").serialize(),--}}
                                {{--dataType: "json",--}}
                                {{--success: function(data) {--}}
                                    {{--if(data){--}}
                                        {{--layer.msg('保存成功!', {icon: 1});--}}
                                    {{--}else{--}}
                                        {{--layer.msg('保存失败，请重试!', {icon: 2});--}}
                                    {{--}--}}

                                    {{--layer.close(index);--}}
                                    {{--layer.close(loaddingIndex);--}}
                                {{--}--}}
                            {{--});--}}

                            {{--// layer.close(index);--}}
                            {{--// layer.msg('保存成功!', {icon: 1});--}}
                        {{--}--}}
                    {{--});--}}

                    {{--var sortable = new Sortable(document.querySelector("#sortable-items"), {--}}
                        {{--group: "sortable-items",  // or { name: "...", pull: [true, false, clone], put: [true, false, array] }--}}
                        {{--sort: true,  // sorting inside list--}}
                        {{--delay: 0, // time in milliseconds to define when the sorting should start--}}
                        {{--disabled: false, // Disables the sortable if set to true.--}}
                        {{--store: null,  // @see Store--}}
                        {{--animation: 150,  // ms, animation speed moving items when sorting, `0` — without animation--}}
                        {{--handle: ".sortable-item",  // Drag handle selector within list items--}}
                        {{--filter: ".ignore-elements",  // Selectors that do not lead to dragging (String or Function)--}}
                        {{--draggable: ".sortable-item",  // Specifies which items inside the element should be draggable--}}
                        {{--ghostClass: "sortable-ghost",  // Class name for the drop placeholder--}}
                        {{--chosenClass: "sortable-chosen",  // Class name for the chosen item--}}
                        {{--dragClass: "sortable-drag",  // Class name for the dragging item--}}
                        {{--dataIdAttr: 'data-id',--}}

                        {{--forceFallback: false,  // ignore the HTML5 DnD behaviour and force the fallback to kick in--}}

                        {{--fallbackClass: "sortable-fallback",  // Class name for the cloned DOM Element when using forceFallback--}}
                        {{--fallbackOnBody: false,  // Appends the cloned DOM Element into the Document's Body--}}
                        {{--fallbackTolerance: 0, // Specify in pixels how far the mouse should move before it's considered as a drag.--}}

                        {{--scroll: true, // or HTMLElement--}}
                        {{--scrollFn: function(offsetX, offsetY, originalEvent) {--}}

                        {{--}, // if you have custom scrollbar scrollFn may be used for autoscrolling--}}
                        {{--scrollSensitivity: 30, // px, how near the mouse must be to an edge to start scrolling.--}}
                        {{--scrollSpeed: 10, // px--}}

                        {{--setData: function (/** DataTransfer */dataTransfer, /** HTMLElement*/dragEl) {--}}
                            {{--dataTransfer.setData('Text', dragEl.textContent); // `dataTransfer` object of HTML5 DragEvent--}}
                        {{--},--}}

                        {{--// Element is chosen--}}
                        {{--onChoose: function (/**Event*/evt) {--}}
                            {{--evt.oldIndex;  // element index within parent--}}
                        {{--},--}}

                        {{--// Element dragging started--}}
                        {{--onStart: function (/**Event*/evt) {--}}
                            {{--evt.oldIndex;  // element index within parent--}}
                        {{--},--}}

                        {{--// Element dragging ended--}}
                        {{--onEnd: function (/**Event*/evt) {--}}
                            {{--evt.oldIndex;  // element's old index within parent--}}
                            {{--evt.newIndex;  // element's new index within parent--}}
                        {{--},--}}

                        {{--// Element is dropped into the list from another list--}}
                        {{--onAdd: function (/**Event*/evt) {--}}
                            {{--var itemEl = evt.item;  // dragged HTMLElement--}}
                            {{--evt.from;  // previous list--}}
                            {{--// + indexes from onEnd--}}
                        {{--},--}}

                        {{--// Changed sorting within list--}}
                        {{--onUpdate: function (/**Event*/evt) {--}}
                            {{--var itemEl = evt.item;  // dragged HTMLElement--}}
                            {{--// + indexes from onEnd--}}
                        {{--},--}}

                        {{--// Called by any change to the list (add / update / remove)--}}
                        {{--onSort: function (/**Event*/evt) {--}}
                            {{--// same properties as onUpdate--}}
                        {{--},--}}

                        {{--// Element is removed from the list into another list--}}
                        {{--onRemove: function (/**Event*/evt) {--}}
                            {{--// same properties as onUpdate--}}
                        {{--},--}}

                        {{--// Attempt to drag a filtered element--}}
                        {{--onFilter: function (/**Event*/evt) {--}}
                            {{--var itemEl = evt.item;  // HTMLElement receiving the `mousedown|tapstart` event.--}}
                        {{--},--}}

                        {{--// Event when you move an item in the list or between lists--}}
                        {{--onMove: function (/**Event*/evt, /**Event*/originalEvent) {--}}
                            {{--// Example: http://jsbin.com/tuyafe/1/edit?js,output--}}
                            {{--evt.dragged; // dragged HTMLElement--}}
                            {{--evt.draggedRect; // TextRectangle {left, top, right и bottom}--}}
                            {{--evt.related; // HTMLElement on which have guided--}}
                            {{--evt.relatedRect; // TextRectangle--}}
                            {{--originalEvent.clientY; // mouse position--}}
                            {{--// return false; — for cancel--}}
                        {{--},--}}

                        {{--// Called when creating a clone of element--}}
                        {{--onClone: function (/**Event*/evt) {--}}
                            {{--var origEl = evt.item;--}}
                            {{--var cloneEl = evt.clone;--}}
                        {{--}--}}
                    {{--});--}}

                    {{--// 初始化上传控件--}}
                    {{--upload.render({--}}
                        {{--elem: '#block-multiple-files-upload' // 绑定元素--}}
                        {{--,url: '{{ route('upload.image') }}?folder=article&object_id=' + tId // 上传接口--}}
                        {{--,field: 'upload_file'--}}
                        {{--,done: function(res){--}}
                            {{--if(res.success == true){--}}
                                {{--var html = '<div class="sortable-item">\n' +--}}
                                    {{--'\t\t  <div class="block-multiple-files-item"><input type="hidden" name="multiple_files[]" value="'+ res.file_uri +'" /> <img src="' + res.file_path + '" /></div>\n' +--}}
                                    {{--'\t\t<a href="javascript:;" class="sortable-item-delete">删除</a></div>\n';--}}

                                {{--$("#sortable-items").append(html);--}}
                            {{--}--}}
                            {{--//上传完毕回调--}}
                            {{--console.log(res);--}}
                        {{--}--}}
                        {{--,error: function(){--}}
                            {{--//请求异常回调--}}
                            {{--layer.alert('上传失败，请重试!', 2);--}}
                        {{--}--}}
                    {{--});--}}
                {{--}--}}
            {{--});--}}

            {{--return false;--}}
        {{--});--}}
        {{----}}
        {{--$("body").on("click", ".sortable-item-delete", function(){--}}
            {{--var _this = $(this);--}}
            {{--layer.confirm('真的要删除吗？', {--}}
                {{--btn: ['确定','取消']--}}
            {{--}, function(index){--}}
                {{--_this.parent().remove();--}}
                {{--layer.close(index);--}}
            {{--}, function(){--}}

            {{--});--}}
        {{--});--}}
    {{--});--}}
</script>