<script type="text/javascript">

    var uploader = WebUploader.create({
        // swf文件路径
        swf: "{{asset('vendor/laracms/plugins/webuploader/Uploader.swf')}}",
        // 文件接收服务端。
        server: "{{ route('uploader') }}?file_type=image&folder={{$folder}}&object_id={{$object_id}}",
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
            title: 'Images',
            extensions: '{{ implode(',', config('filesystems.uploader.image.allowed_ext'))  }}',
            mimeTypes: 'image/jpg,image/jpeg,image/png'
        },
        fileNumLimit: 100,
        fileSingleSizeLimit: {{ config('filesystems.uploader.annex.size_limit') }},
        auto: true
    });

    uploader.on('error', function (type) {
        // console.log(type);
        if( type == 'Q_TYPE_DENIED'){
            new $.zui.Messager('文件类型错误,请选择: {{ implode(',', config('filesystems.uploader.annex.allowed_ext'))  }} 格式文件', {
                type : 'warning',
                icon: 'icon icon-info-sign'
            }).show();
        }else if( type == 'F_EXCEED_SIZE'){
            new $.zui.Messager('文件大小不能超过: {{ byte_to_size(config('filesystems.uploader.annex.size_limit')) }}', {
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

    uploader.on( 'uploadSuccess', function( file, response) {
        if(response.success == true){
            $("{{$fieldElem}}").val(response.path);
            $("{{$previewElem}}").attr("src",response.url);
        }
    });

</script>