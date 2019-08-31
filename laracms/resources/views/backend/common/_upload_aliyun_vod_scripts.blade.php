<script type="text/javascript">

    var message = null;

    var uploader = WebUploader.create({
        // swf文件路径
        swf: "{{asset('vendor/laracms/plugins/webuploader/Uploader.swf')}}",
        // 文件接收服务端。
        server: "",
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: "{{ $elem }}",
        formData: {
            _token:'{{csrf_token()}}'
        },
        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: false,
        chunked: false, // 是否分片
        chunkSize:5242880, // 单片大小，默认5MB
        fileVal: 'upload_file',
        accept: {
            title: 'Video',
            extensions: '{{ implode(',', config('filesystems.uploader.video.allowed_ext'))  }}',
            mimeTypes: 'video/mp4'
        },
        fileNumLimit: 100,
        fileSingleSizeLimit: {{ config('filesystems.uploader.annex.size_limit') }},
        auto: false
    });

    uploader.on('error', function (type) {
        // console.log(type);
        if( type == 'Q_TYPE_DENIED'){
            new $.zui.Messager('文件类型错误,请选择: {{ implode(',', config('filesystems.uploader.video.allowed_ext'))  }} 格式文件', {
                type : 'warning',
                icon: 'icon icon-info-sign'
            }).show();
        }else if( type == 'F_EXCEED_SIZE'){
            new $.zui.Messager('文件大小不能超过: {{ byte_to_size(config('filesystems.uploader.video.size_limit')) }}', {
                type : 'warning',
                icon: 'icon icon-info-sign'
            }).show();
        }else if( type == 'Q_EXCEED_NUM_LIMIT' ){
            new $.zui.Messager('单次只能上传100个文件，请勿过多选择.', {
                type : 'warning',
                icon: 'icon icon-info-sign'
            }).show();
        }
    });

    //前一个文件未传完，不能再添加文件
    uploader.on('beforeFileQueued', function (file) {
        //console.log(file.source);
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

    // 文件加入队列后开始上传
    uploader.on('fileQueued', function (file) {
        // console.log(file);
        message = new $.zui.Messager('计算文件校验值中...', {
            type : 'info',
            icon: 'icon icon-spin icon-spinner-indicator',
            placement : 'bottom-left',
            time : 0,
            close: false
        }).show();

        uploader.md5File(file.source).fail(function () {
            // console.log('计算文件MD5值....');
        }).progress(function (percentage) {
            // console.log('读取文件进度:' + parseInt(percentage * 100) + "%");
        }).then(function (md5Value) {
            // console.log('文件验证完毕. MD5:' + md5Value);
            message.hide(); // 关闭消息
            file.md5 = md5Value;

            window.vod || (window.vod = {});
            window.vod.file = file;

            // 获取上传文件上传凭证
            var response = get_vod_uploader_auth(file);
            // console.log(response);
            if( response ==  'aliyun'){
                start_uploader_vod_file(file);
            }else if( response.title ){
                // 文件已上传过，无需重复上传，直接引用即可
                message.hide();
                uploader.removeFile(window.vod.file, true); // 从 webuploader 队列里面删除
                $("{{$fieldIdElem}}").val(response.storage_id);
                $("{{$fieldTitleElem}}").val(response.title);
                $("{{$previewElem}}").html(response.title);
            }else{
                uploader.removeFile(file, true); // 从 webuploader 队列里面删除
                message.hide();
                // 获取上传凭证失败
                new $.zui.Messager('获取上传凭证失败.', {
                    type : 'warning',
                    icon: 'icon icon-info-sign'
                }).show();
            }

        });
    });

    // 开始上传
    function start_uploader_vod_file(file) {
        var userData = '{"Vod":{"StorageLocation":"","UserData":{"IsShowWaterMark":"false","Priority":"7"}}}';
        aliyunUploader.addFile(file.source._raw, null, null, null, userData);
        aliyunUploader.startUpload();
        message = new $.zui.Messager('文件上传中...', {
            type : 'info',
            icon: 'icon icon-spin icon-spinner-indicator',
            placement : 'bottom-left',
            time : 0,
            close: false
        }).show();
    }

    /**
     * 获取文件上传凭证
     *
     * @param file
     * @returns {boolean}
     */
    function get_vod_uploader_auth(file){
        var server      = "{{ route('uploader.aliyun.vod.auth') }}?file_type=image&folder={{$folder}}&object_id={{$object_id}}";
        var formData    = {};

        var response = false;

        formData.fileMd5    = file.md5;
        formData.title      = file.name.replace("."+file.ext, "");
        formData.fileName   = file.name;
        formData.fileSize   = file.size;
        formData.mimeType   = file.type;

        // console.log(formData);
        // 请求后端进行MD5校验
        $.ajax(server, {
            dataType: 'json',
            type: 'post',
            data: formData,
            cache: false,
            async : false,
            timeout: 1000,
            success:function (json, textStatus) {
                if (json.code == 0 && json.message == 'existed') {
                    response = json.data;
                }else if(json.code == 0){
                    response = 'aliyun';
                    if(response.UploadAuth && response.UploadAddress){
                        window.vod || (window.vod = {});
                        window.vod.uploadAuth = response.UploadAuth;
                        window.vod.uploadAddress = response.UploadAddress;
                        window.vod.videoId = response.VideoId;
                    }
                }
            }
        });

        return response;
    }

    /* ============================================================================================================== */
    var aliyunUploader = new AliyunUpload.Vod({
        // 文件上传失败
        'onUploadFailed': function (uploadInfo, code, message) {
            uploader.removeFile(window.vod.file, true); // 从 webuploader 队列里面删除
            aliyunUploader.cleanList(); // 清理阿里云上传列表
            message.hide();
            new $.zui.Messager('上传失败.', {
                type : 'danger',
                icon: 'icon icon-remove-sign',
                placement : 'bottom-left',
                time : 3000,
                close: false
            }).show();

            log("onUploadFailed: file:" + uploadInfo.file.name + ",code:" + code + ", message:" + message);
        },
        // 文件上传完成
        'onUploadSucceed': function (uploadInfo) {
            uploader.removeFile(window.vod.file, true); // 从 webuploader 队列里面删除
            aliyunUploader.cleanList(); // 清理阿里云上传列表
            message.hide();
            log("onUploadSucceed: " + uploadInfo.file.name + ", endpoint:" + uploadInfo.endpoint + ", bucket:" + uploadInfo.bucket + ", object:" + uploadInfo.object);
            uploadComlateSucceed(uploadInfo);
        },
        // 文件上传进度
        'onUploadProgress': function (uploadInfo, totalSize, loadedPercent) {
            log("onUploadProgress:file:" + uploadInfo.file.name + ", fileSize:" + totalSize + ", percent:" + (loadedPercent * 100.00).toFixed(2) + "%");
        },
        'onUploadTokenExpired': function (uploadInfo) {
            log("onUploadTokenExpired");

        },
        onUploadCanceled:function(uploadInfo)
        {
            log("onUploadCanceled:file:" + uploadInfo.file.name);
        },
        // 开始上传
        'onUploadstarted': function (uploadInfo) {

            // console.log(uploadInfo);

            if(!uploadInfo.videoId) //这个文件没有上传异常
            {
                var uploadAuth = window.vod.uploadAuth;
                var uploadAddress = window.vod.uploadAddress;
                var videoId = window.vod.videoId;

                // console.log(uploadAuth, uploadAddress, videoId);

                aliyunUploader.setUploadAuthAndAddress(uploadInfo, uploadAuth, uploadAddress,videoId);
            }
            else//如果videoId有值，根据videoId刷新上传凭证
            {
                var uploadAuth = window.vod.uploadAuth;
                var uploadAddress = window.vod.uploadAddress;
                aliyunUploader.setUploadAuthAndAddress(uploadInfo, uploadAuth, uploadAddress);
            }

            log("onUploadStarted:" + uploadInfo.file.name + ", endpoint:" + uploadInfo.endpoint + ", bucket:" + uploadInfo.bucket + ", object:" + uploadInfo.object);
        }
        ,
        'onUploadEnd':function(uploadInfo){
            log("onUploadEnd: uploaded all the files");
        }
    });


    // 文件上传完毕操作
    function uploadComlateSucceed(response){
        // console.log(response);
        message.hide();

        var title = response.file.name;

        // 设置页面视频标题，视频ID，视频封面后台自动更新页面上不做处理
        $("{{$fieldIdElem}}").val(response.videoId);
        $("{{$fieldTitleElem}}").val(title);
        $("{{$previewElem}}").html(title);

        // 更新文件信息及状态
        var server      = "{{ route('uploader.aliyun.vod.update') }}?file_type=image&folder={{$folder}}&object_id={{$object_id}}";
        var formData    = {};

        formData.vodeoId   = response.videoId;
        formData.path      = response.object;

        $.ajax(server, {
            dataType: 'json',
            type: 'post',
            data: formData,
            cache: false,
            async : true,
            timeout: 1000,
            success:function (json, textStatus) {
            }
        });
    }

    function log(value){
        if(!value){
            return;
        }

        console.log('vod:'+value);
    }


</script>