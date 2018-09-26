<script type="text/javascript"  src="{{ asset('plugins/editor/js/module.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/hotkeys.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/uploader.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/simditor.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/beautify-html.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/simditor-html.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/to-markdown.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/marked.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/simditor-markdown.js') }}"></script>

<script>

    var $preview, editor, mobileToolbar, toolbar;
    Simditor.locale = 'en-US';
    toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment', '|', 'html', 'markdown'];
    mobileToolbar = ["bold", "underline", "strikethrough", "color", "ul", "ol"];
    // if (mobilecheck()) {
    //     toolbar = mobileToolbar;
    // }

    $(".editor").each(function(){
        Simditor.locale = 'zh-CN';
        new Simditor({
            textarea: $(this),
            upload: {
                url: '{{ route('uploader') }}?file_type=image&folder={{$folder}}&editor=1&object_id={{$object_id ?? 0}}',
                params: { _token: '{{ csrf_token() }}' },
                fileKey: 'upload_file',
                connectionCount: 3,
                leaveConfirm: '文件上传中，关闭此页面将取消上传。'
            },
            pasteImage: true,
            toolbar:toolbar,
            locale:'zh-CN',
        });
    });
</script>