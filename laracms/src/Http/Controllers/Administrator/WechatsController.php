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

namespace Wanglelecc\Laracms\Http\Controllers\Administrator;

use Wanglelecc\Laracms\Models\Wechat;
use Illuminate\Http\Request;
use Wanglelecc\Laracms\Http\Requests\Administrator\WechatRequest;

/**
 * 微信公众号管理控制器
 *
 * Class WechatsController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class WechatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        static::$activeNavId = 'website.wechat';
    }

    /**
     * 列表
     *
     * @return mixed
     */
	public function index()
	{
		$wechats = Wechat::paginate(config('administrator.paginate.limit'));
		return backend_view('wechats.index', compact('wechats'));
	}

    /**
     * 详情
     *
     * @param Wechat $wechat
     * @return mixed
     */
    public function show(Wechat $wechat)
    {
        return backend_view('wechats.show', compact('wechat'));
    }

    /**
     * 创建
     *
     * @param Wechat $wechat
     * @return mixed
     */
	public function create(Wechat $wechat)
	{
		return backend_view('wechats.create_and_edit', compact('wechat'));
	}

    /**
     * 保存
     *
     * @param WechatRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
	public function store(WechatRequest $request)
	{
		$wechat = Wechat::create($request->all());

		return $this->redirect('wechats.index')->with('success', '添加成功.');
	}

    /**
     * 编辑
     *
     * @param Wechat $wechat
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function edit(Wechat $wechat)
	{
        $this->authorize('update', $wechat);

		return backend_view('wechats.create_and_edit', compact('wechat'));
	}

    /**
     * 更新
     *
     * @param WechatRequest $request
     * @param Wechat $wechat
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function update(WechatRequest $request, Wechat $wechat)
	{
		$this->authorize('update', $wechat);

		$wechat->update($request->all());

		return $this->redirect('wechats.index')->with('success', '更新成功.');
	}

    /**
     * 删除
     *
     * @param Wechat $wechat
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function destroy(Wechat $wechat)
	{
		$this->authorize('destroy', $wechat);
		$wechat->delete();

		return $this->redirect()->with('success', '删除成功.');
	}

    /**
     * 接入
     *
     * @param Wechat $wechat
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function integrate(Wechat $wechat){
        $this->authorize('show', $wechat);

        return backend_view('wechats.integrate', compact('wechat'));
    }

}