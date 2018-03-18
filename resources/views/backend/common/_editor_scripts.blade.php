<script type="text/javascript"  src="{{ asset('plugins/editor/js/module.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/hotkeys.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/uploader.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/simditor.js') }}"></script>

<script>
    $(".editor").each(function(){
        new Simditor({
            textarea: $(this),
            upload: {
                url: '{{ route('upload.image') }}?folder={{$folder}}&editor=1&object_id={{$object_id ?? 0}}',
                params: { _token: '{{ csrf_token() }}' },
                fileKey: 'upload_file',
                connectionCount: 3,
                leaveConfirm: '文件上传中，关闭此页面将取消上传。'
            },
            pasteImage: true,
        });
    });
</script>