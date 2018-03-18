<style type="text/css" media="screen">
    /*.codeeditor-wrapper {width:100%;height:300px;}*/
    body.codeeditor-fullscreen .form-action {position: fixed; bottom: 5px; left: 50px; z-index: 1105; width: 600px}
    .editor-wrapper {position: relative; z-index: 1;}
    .editor-wrapper pre {z-index: 2; margin-bottom: 0; border:solid 1px #ddd; margin-top: 0;}
    .editor-wrapper .actions {position: absolute; right: 0; bottom: 15px; z-index: 3;}
    .editor-wrapper .actions > a {opacity: .8; color: #808080; border: 1px solid #ccc; min-width: 14px; height: 16px; line-height: 16px; text-align: center; display: block; width: 16px; text-align: center;}
    .editor-wrapper .actions > a:hover {color: #fff; background-color: #3280fc; border-color: #3280fc}
    .editor-wrapper.fullscreen {position: fixed; left: 0; top: 40px; bottom: 40px; right: 0; z-index: 10}
    .editor-wrapper.fullscreen .pre {height: 100%; width: 100%}
    .editor-wrapper.fullscreen .actions > a {background-color: #ea644a; color: #fff; border-color: #ea644a; opacity: 1}

    .modal-dialog.editor-fullscreen {position: absolute; bottom: 0; right: 0; top: 0; left: 0;  width: 100%!important; margin: 0!important; height: auto!important; border-radius: 0}
    .modal-dialog.editor-fullscreen .editor-wrapper.fullscreen {bottom: 80px;}
    .modal-dialog.editor-fullscreen .editor-actions {position: fixed; bottom: 15px; left: 20px;}

    .editor-resizer {position: absolute; bottom: 0; width: 16px; right: 0; text-align: center; cursor: s-resize; z-index: 4; opacity: .8; transition: opacity .2s; border: 1px solid #ccc; line-height: 16px; height: 16px; background: #f1f1f1; color: #808080; background: rgba(255,255,255,.8);}
    .editor-resizer:hover {opacity: 1}
</style>