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

namespace App\Http\Controllers\Administrator;

use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 媒体控制器
 *
 * Class MediaController
 * @package App\Http\Controllers\Administrator
 */
class MediaController extends Controller
{
    /**
     * 图片
     *
     * @param Request $request
     * @param File $file
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function image(Request $request, File $file)
	{
	    $this->authorize('index',$file);

		$images = $file->where('type','image')->recent()->paginate((config('administrator.paginate.limit')));

		return backend_view('media.image', compact('images'));
	}
}