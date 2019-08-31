@php
$editor = config('administrator.editor', 'simditor');
@endphp

@if( 'simditor' == $editor )
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/editor/js/module.js') }}"></script>
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/editor/js/hotkeys.js') }}"></script>
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/editor/js/uploader.js') }}"></script>
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/editor/js/simditor.js') }}"></script>
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/editor/js/beautify-html.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/editor/js/simditor-html.js') }}"></script>
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/editor/js/to-markdown.js') }}"></script>
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/editor/js/marked.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/editor/js/simditor-markdown.js') }}"></script>
<script>
    var $preview, editor, mobileToolbar, toolbar;
    Simditor.locale = 'en-US';
    toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment', '|', 'html', 'markdown'];
    mobileToolbar = ["bold", "underline", "strikethrough", "color", "ul", "ol"];
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
@elseif('ueditor' == $editor)
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/ueditor/ueditor.config.js') }}"></script>
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/ueditor/ueditor.all.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
<script>

    var simple = [[
        'paragraph', 'fontfamily', 'fontsize', 'lineheight', '|',
        'bold', 'italic', 'underline', 'strikethrough', '|',
        'justifyleft', 'justifycenter', 'justifyright', '|',
        'pasteplain', 'emotion', 'simpleupload', '|',
        'link', 'unlink', 'anchor',
        'undo', 'redo', 'removeformat','insertorderedlist', 'insertunorderedlist', '|',
        'source', 'help']];

    var full = [
        [
        'paragraph', 'fontfamily', 'fontsize','|',
        'forecolor', 'backcolor', '|', 'lineheight', 'indent', '|',
        'bold', 'italic', 'underline', 'strikethrough', '|',
        'justifyleft', 'justifycenter', 'justifyright', '|',
        'insertorderedlist', 'insertunorderedlist', 'pasteplain',
        'fullscreen'
        ],
        [
            'undo', 'redo', 'removeformat', '|',
            'link', 'unlink', 'anchor', '|',
            'inserttable', '|',
            'emotion', 'simpleupload', 'insertimage', 'insertvideo', 'map', '|',
            'insertcode', 'source', 'searchreplace', 'help'
        ]
    ];

    var options =
        {
            lang: 'zh-cn',
            toolbars: full,
            serverUrl: "{{ route('uploader.ueditor') }}?file_type=image&folder={{$folder}}&editor=1&object_id={{$object_id ?? 0}}&",
            autoClearinitialContent: false,
            wordCount: false,
            initialStyle: 'p{line-height:1em}embed,.edui-upload-video,.edui-faked-video{background:url(\'/js/ueditor/themes/default/images/videologo.gif\') no-repeat center center; border:1px solid gray;}',
            enableAutoSave: false,
            elementPathEnabled: false,
            initialFrameWidth: '100%',
            autoHeightEnabled: false,
            initialFrameHeight: 400,
            zIndex: 5,
            removeFormatTags: 'big,dfn,font,ins,strike,tt,u',
            removeFormatAttributes: 'lang,hspace',
            allowDivTransToP: false
        };
    if(!window.editor) window.editor = {};


    window.ueditor = [];
    $(".editor").each(function(index){

        this.classList.remove('form-control');
        this.style.height = '400px';

        window.ueditor[index] =  UE.getEditor($(this).attr('id'), options);

        window.ueditor[index].addListener('ready', function()
        {
            $(this.container).parent().removeClass('form-control');
        });

        window.ueditor[index].addListener('fullscreenchanged', function(e, fullscreen)
        {
            var $container = $(this.container).css('z-index', fullscreen ? 1050 : 5);
            if (fullscreen && window.navigator.userAgent.indexOf('Firefox') > -1) {
                $container.css('top', 0);
            }
        });

    });
</script>
@endif