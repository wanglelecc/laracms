<script type="text/javascript"  src="{{ asset('vendor/laracms/plugins/ace/ace.js') }}"></script>
<script type="text/javascript">
    jQuery.fn.codeeditor = function(options)
    {
        return this.each(function()
        {
            var $this = $(this);
            var setting = $.extend({mode: $this.data('mode') || 'html', theme: 'textmate'}, $this.data(), options);
            if(setting.height) $this.css('height', setting.height);
            $this.css('display', 'none');
            var name = $this.attr('id');
            console.log(name);
            var id = name + '-editor';
            var textarea = $this;

            console.log(id);

            $this.before('<div class="editor-wrapper"><pre id="'+id+'"></pre></div>');
            var $editor = $('#' + id).addClass('ace-editor').height($this.height());

            var editor = ace.edit(id);
            var $wrapper = $editor.closest('.editor-wrapper'),
                session = editor.getSession();
            editor.setOptions({fontSize: '15px'});
            console.log(textarea.val());
            editor.setValue(textarea.val()); // 需要修改
            editor.setShowPrintMargin(false);
            editor.clearSelection();
            session.setMode("ace/mode/" + setting.mode);
            session.setUseWorker(false);
            session.on('change', function(e)
            {
                var value = editor.getValue();
                $this.val(value); // 需要修改
                textarea.val(value);
            });

            $this.data('editor', editor).data('editorId', id);
            $wrapper.on('click', '.btn-fullscreen', function(){
                $wrapper.toggleClass('fullscreen');
                $wrapper.closest('.modal-dialog').toggleClass('editor-fullscreen');
                $('body').toggleClass('codeeditor-fullscreen');
                $(this).find('i').toggleClass('icon-resize-small');
                if($wrapper.hasClass('fullscreen'))
                {
                    $editor.data('origin-height', $editor.height()).height($wrapper.height());
                }
                else
                {
                    $editor.height($editor.data('origin-height'));
                }
                editor.resize();
            }).on('mousedown', '.editor-resizer', function(e){
                var dragStartData = {y: e.screenY, height: $editor.outerHeight()};
                $wrapper.data('dragStartData', dragStartData);
                e.preventDefault();
            });
            $(document).on('mousemove', function(e){
                var dragStartData = $wrapper.data('dragStartData');
                if(dragStartData) {
                    var newHeight = dragStartData.height + e.screenY - dragStartData.y - 21;
                    $editor.height(newHeight);
                    e.preventDefault();
                    editor.resize();
                }
            }).on('mouseup', function(){
                $wrapper.data('dragStartData', null);
            });
        });
    };
    $(function() {
        $('.codeeditor').codeeditor();
    });
</script>