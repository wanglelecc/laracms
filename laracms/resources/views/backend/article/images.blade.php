@php
        $object_id = $article->object_id ?? create_object_id();
        $field = 'images';
@endphp
    <div id='myUploader' class="uploader">
        <div>
            {{--<div class="btn-group">--}}
                <button id="uploader-btn-browse" type="button" class="btn btn-info"><i class="icon icon-upload"></i> 上传</button>
                <button id="selected-btn-browse" type="button" class="btn btn-primary"><i class="icon icon-file-image"></i> 选择</button>

                {{--<button id="uploader-btn-start" type="button" class="btn btn-link "><i class="icon icon-cloud-upload"></i> 开始上传</button>--}}
                <small style="margin-left: 10px;">单个文件大小不能超过: {{ byte_to_size(config('filesystems.uploader.image.size_limit')) }}</small>
            {{--</div>--}}
            <hr class="divider" style="margin-top: 10px;">
        </div>
        <div class="uploader-files file-list file-list-grid" data-drag-placeholder="">

            @foreach($images as $image)
            @php
            $image = $image->toArray();
            @endphp

            <div class="file file-static" data-id="{{$image['id']}}">
                <div class="file-wrapper">
                    <div class="file-icon">
                        <div class="file-icon-image" style="background-image: url('{{ $image['url'] }}')"></div>
                    </div>
                    <div class="actions">
                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-delete-file" style="display:inline-block;" data-original-title="移除"><i class="icon icon-trash text-danger"></i></button>
                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-sort-file" style="display:inline-block;"><i class="icon icon-move"></i></button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

<style>
    .file-list-grid .file{ margin-bottom: 10px; }
    .modal-dialog{ width: 700px; }
</style>

<script>

    var message = null;
    var guid = WebUploader.Base.guid();
    var chunked = true;
    var chunkSize = 5 * 1024 * 1024;
    var chunkRetry = 5;

    var uploader = WebUploader.create({
        // swf文件路径
        swf: "{{asset('vendor/laracms/plugins/webuploader/Uploader.swf')}}",
        // 文件接收服务端。
        server: "{{ route('uploader') }}",
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: "#uploader-btn-browse",
        formData: {
            _token:'{{csrf_token()}}',
            article_id : '{{ $article->id }}',
            field : '{{$field}}',
            uploader_type : 'multiple',
            object_id : '{{$object_id}}',
            file_type : 'image',
            folder : 'article'
        },
        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        compress:false,
        resize: false,
        chunked: chunked, // 是否分片
        chunkSize: chunkSize, // 单片大小，默认5MB
        chunkRetry: chunkRetry,
        threads: 1,
        fileVal: 'upload_file',
        accept: {
            title: 'Images',
            extensions: '{{ implode(',', config('filesystems.uploader.image.allowed_ext'))  }}',
            mimeTypes: 'image/jpg,image/jpeg,image/png'
        },
        fileNumLimit:100,
        fileSingleSizeLimit: {{ config('filesystems.uploader.annex.size_limit') }},
        auto: true
    });

    // 监听文件开始上传事件
    uploader.on('startUpload', function () {
    });

    // 监听文件上传失败事件
    uploader.on('uploadError', function () {

    });

    //前一个文件未传完，不能再添加文件
    uploader.on('beforeFileQueued', function (file) {
        var stats = uploader.getStats();
        if(stats.progressNum > 0){
            new $.zui.Messager('请等待上一个文件传完！', {
                type : 'danger',
                icon: 'icon icon-remove-sign',
                placement : 'bottom-left',
                time : 3000,
                close: false
            }).show();
            return false;
        }
    });

    uploader.on('error', function (type) {
        // console.log(type);
        if( type == 'Q_TYPE_DENIED'){
            new $.zui.Messager('文件类型错误,请选择: {{ implode(',', config('filesystems.uploader.annex.allowed_ext'))  }} 格式文件', {
                placement : 'bottom-left',
                type : 'warning',
                icon: 'icon icon-info-sign'
            }).show();
        }else if( type == 'F_EXCEED_SIZE'){
            new $.zui.Messager('文件大小不能超过: {{ byte_to_size(config('filesystems.uploader.annex.size_limit')) }}', {
                placement : 'bottom-left',
                type : 'warning',
                icon: 'icon icon-info-sign'
            }).show();
        }else if( type == 'Q_EXCEED_NUM_LIMIT' ){
            new $.zui.Messager('单次只能上传100个文件，请勿过多选择.', {
                placement : 'bottom-left',
                type : 'warning',
                icon: 'icon icon-info-sign'
            }).show();
        }
    });

    uploader.on( 'uploadSuccess', function( file, response) {
        UploadComlate(file, response);
    });

    $("#myUploader").on('click', '.btn-delete-file', function(){
        var that = $(this);
        var file = that.parent().parent().parent();

        bootbox.confirm({
            size: "small",
            title: "系统提示",
            message: "确认移除吗？",
            callback: function(result){ if(result === true){
                @php
                    $haystack = route('articles.multiple.files.destroy',[ $article->id, $field, '0' ]);
                    $url = substr($haystack, 0, strrpos($haystack, '/') + 1)
                @endphp
                $.ajax({
                    type: 'post',
                    url: '{{$url}}'+file.attr('data-id'),
                    data: {
                        _method : 'DELETE',
                    },
                    dataType: "json",
                    success: function(data) {
                        file.remove();
                        new $.zui.Messager('已移除！', {
                            placement : 'bottom-left',
                            type : 'info',
                            icon: 'icon icon-check-circle'
                        }).show();
                    }
                });
            } }
        });

        return false;
    });
    
    function UploadComlate(file, response) {
        message.hide();
        if(response.success == true){
            var li = $('<div class="file file-static" data-id="'+ response.multiple_id +'">\n' +
                '                <div class="file-wrapper">\n' +
                '                    <div class="file-icon">\n' +
                '                        <div class="file-icon-image" style="background-image: url('+ response.url +')"></div>\n' +
                '                    </div>\n' +
                '                    <div class="actions">\n' +
                '                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-delete-file" style="display:inline-block;" data-original-title="移除"><i class="icon icon-trash text-danger"></i></button>\n' +
                '                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-sort-file" style="display:inline-block;"><i class="icon icon-move"></i></button>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            </div>');

            $(".file-list").append(li);
        }else{
            message.hide();
            new $.zui.Messager(response.message, {
                type : 'danger',
                icon: 'icon icon-remove-sign',
                placement : 'bottom-left',
                time : 3000,
                close: false
            }).show();
        }
    }

    // 拖动排序
    function sortFile()
    {
        $('.file-list').sortable(
            {
                trigger: '.icon-move',
                selector: '.file',
                finish: function(e)
                {
                   var orderArr = [];
                   e.list.each(function(){
                       var id = $(this).attr('data-id');
                       var order = $(this).attr('data-order');
                       orderArr.push({
                           id : id,
                           order : order
                       });
                   });

                   // 请求后端排序
                    $.ajax({
                        type: 'post',
                        url: '{{ route('articles.multiple.files.order',[ $article->id, $field ]) }}',
                        data: {
                            _method : 'PUT',
                            params : orderArr
                        },
                        dataType: "json",
                        success: function(data) {
                        }
                    });
                }
            });
    }

    sortFile();
</script>
