<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Handlers\UploadHandler;

class UploadController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 文件上传控制器
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    protected $folder = ['avatar', 'article', 'blog', 'page', 'website', 'slide', 'link', 'navigation'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function image(Request $request, UploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => '',
            'file_uri' => '',
        ];

        // 如果上传的不是图片将终止操作
        if ( ! in_array($request->folder, $this->folder)) {
            return $data;
        }

        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->saveImage(intval($request->object_id ?? 0), $request->upload_file, $request->folder, intval($request->editor ?? 0), strtolower(substr($request->folder,0,1)), 1024);

            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['file_uri'] = $result['uri'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }

        return $data;
    }
}
