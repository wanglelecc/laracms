<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Handlers\UploadHandler;

/**
 * 文件上传控制器
 *
 * Class UploadController
 * @package App\Http\Controllers
 */
class UploadController extends Controller
{
    // 允许类型
    protected $folder = ['avatar', 'article', 'blog', 'page', 'website', 'slide', 'link', 'video', 'annex', 'voice', 'navigation'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 图片上传
     *
     * @param Request $request
     * @param UploadHandler $uploader
     * @return array
     */
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
