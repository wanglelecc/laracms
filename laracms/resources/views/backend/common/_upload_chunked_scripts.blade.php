<script>
    chunked = true;
    chunkSize = 5 * 1024 * 1024;
    chunkRetry = 10;

    // console.log(uploader);

    WebUploader.Uploader.register({
    "before-send-file": "beforeSendFile",
    "before-send": "beforeSend",
    "after-send-file": "afterSendFile"
    },{
    // 在文件发送之前request，此时还没有分片（如果配置了分片的话），可以用来做文件整体md5验证。=== 秒传
    beforeSendFile : function (file) {
    var owner       = this.owner;
    var server      = "{{ route('uploader.check.md5') }}";
    var deferred    = WebUploader.Deferred();
    var formData    = this.options.formData;

    message = new $.zui.Messager('计算文件校验值中...', {
    type : 'info',
    icon: 'icon icon-spin icon-spinner-indicator',
    placement : 'bottom-left',
    time : 0,
    close: false
    }).show();

    owner.md5File(file.source).fail(function () {
        deferred.reject();
        console.log('计算文件MD5值....');
    }).progress(function (percentage) {
        console.log('读取文件进度:' + parseInt(percentage * 100) + "%");
    }).then(function (md5Value) {
        console.log('文件验证完毕. MD5:' + md5Value);

        message.hide(); // 关闭消息

        file.wholeMd5 = md5Value;
        formData.md5 = md5Value;

        // 请求后端进行MD5校验
        $.ajax(server, {
            dataType: 'json',
            type: 'post',
            data: formData,
            cache: false,
            timeout: 1000
        }).then(function (response, textStatus, jqXHR) {

        // 记录一下文件 MD5
        file.uniqueFileName = md5Value;

        if (response.success === true &&  response.code === 0) {
            // 存在

            deferred.reject();

            // 设置文件已上传
            owner.skipFile(file);

            // 设置界面上新增文件
            UploadComlate(file, response);

    } else if(response.success == false && response.code === 5) {
    // 不存在

        message = new $.zui.Messager('文件上传中...', {
            type : 'info',
            icon: 'icon icon-spin icon-spinner-indicator',
            placement : 'bottom-left',
            time : 0,
            close: false
        }).show();

        deferred.resolve();
    }else{
        // 其它情况，抛出错误信息,从队列中移除已上传的文件
        owner.removeFile( file, true );
        console.log(response.message);

    message.hide();
    new $.zui.Messager(response.message, {
    type : 'danger',
    icon: 'icon icon-remove-sign',
    placement : 'bottom-left',
    time : 3000,
    close: false
    }).show();

    deferred.reject();

    }

    }, function (jqXHR, textStatus, errorThrown) {
    deferred.resolve();
    });

    });

    return deferred.promise();
    },

    // 在分片发送之前request，可以用来做分片验证，如果此分片已经上传成功了，可返回一个rejected promise来跳过此分片上传 === 断点续传
    beforeSend : function (block) {
        //分片验证是否已传过，用于断点续传
        var deferred    = WebUploader.Deferred();
        var server      = "{{ route('uploader.check.chunk') }}";
        var formData    = this.options.formData;

        formData.guid   = block.file.uniqueFileName;
        formData.md5    = block.file.uniqueFileName;
        formData.chunk  = block.chunk;

        $.ajax({
            type: "POST"
            , url: server
            , data: formData
            , cache: false
            , timeout: 1000
            , dataType: "json"
        }).then(function (response, textStatus, jqXHR) {
            if (response.success === true) {
                deferred.reject();
            } else {
                deferred.resolve();
            }
        }, function (jqXHR, textStatus, errorThrown) {    //任何形式的验证失败，都触发重新上传
            deferred.resolve();
        });

        return deferred.promise();
    },

    // 在所有分片都上传完毕后，且没有错误后request，用来做分片验证，此时如果promise被reject，当前文件上传会触发错误。=== 合并分片
    afterSendFile : function (file) {

    message.hide();

    //合并文件
    var chunksTotal = 0;
    if ((chunksTotal = Math.ceil(file.size / chunkSize)) > 1) {

    message = new $.zui.Messager('文件合并中...', {
        type : 'info',
        icon: 'icon icon-spin icon-spinner-indicator',
        placement : 'bottom-left',
        time : 0,
        close: false
    }).show();

    //合并请求
    var deferred    = WebUploader.Deferred();
    var server      = "{{ route('uploader.merge.chunks') }}";
    var formData    = this.options.formData;

    formData.guid           = file.uniqueFileName;
    formData.md5            = file.uniqueFileName;
    formData.chunks         = chunksTotal;
    formData.originalName   = file.source.name;
    formData.mimeType       = file.type;
    formData.extension      = file.ext;

    $.ajax({
        type: "POST"
        , url: server
        , data: formData
        , cache: false
        , dataType: "json"
    }).then(function (response, textStatus, jqXHR) {

    if(response.success === true){
        UploadComlate(file, response);
        // deferred.resolve();
        deferred.reject(); // 返回失败，避免 进入 uploadSuccess 事件
    }else{
        message.hide();
        deferred.reject();
    }
    }, function (jqXHR, textStatus, errorThrown) {
        message.hide();
        deferred.reject();
    });

    return deferred.promise();
    } else {
    // UploadComlate(file);
    }
    }

    });
</script>