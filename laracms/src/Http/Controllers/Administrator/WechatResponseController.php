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
use Wanglelecc\Laracms\Models\WechatResponse;
use Illuminate\Http\Request;
use Wanglelecc\Laracms\Http\Requests\Administrator\WechatResponseRequest;

/**
 * 微信响应控制器
 *
 * Class WechatResponseController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class WechatResponseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        static::$activeNavId = 'website.wechat';
    }

    /**
     * 列表
     *
     * @param Wechat $wechat
     * @return mixed
     */
	public function index(Wechat $wechat)
	{
		$wechat_responses = WechatResponse::where('wechat_id',$wechat->id)->recent('asc')->paginate(config('administrator.paginate.limit'));
		return backend_view('wechat.response.index', compact('wechat_responses', 'wechat'));
	}

    /**
     * 详情
     *
     * @param WechatResponse $wechatResponse
     * @param Wechat $wechat
     * @return mixed
     */
    public function show(WechatResponse $wechatResponse, Wechat $wechat)
    {
        return backend_view('wechat.response.show', compact('wechatResponse','wechat'));
    }

    /**
     * 创建
     *
     * @param WechatResponse $wechat_response
     * @param Wechat $wechat
     * @return mixed
     */
	public function create(WechatResponse $wechat_response, Wechat $wechat)
	{
		return backend_view('wechat.response.create_and_edit', compact('wechat_response','wechat'));
	}

    /**
     * 保存
     *
     * @param WechatResponseRequest $request
     * @param Wechat $wechat
     * @return \Illuminate\Http\RedirectResponse
     */
	public function store(WechatResponseRequest $request, Wechat $wechat)
	{
        $wechatResponse = WechatResponse::create($request->all());

        return $this->redirect('wechat.response.index',$wechat->id)->with('success', '添加成功.');
	}

    /**
     * 编辑
     *
     * @param WechatResponse $wechat_response
     * @param Wechat $wechat
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function edit(WechatResponse $wechat_response, Wechat $wechat)
	{
        $this->authorize('update', $wechat_response);

        return backend_view('wechat.response.create_and_edit', compact('wechat_response','wechat'));
	}

    /**
     * 更新
     *
     * @param WechatResponse $wechatResponse
     * @param WechatResponseRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function update(WechatResponse $wechatResponse, WechatResponseRequest $request)
	{
		$this->authorize('update', $wechatResponse);
        $wechatResponse->update($request->all());

		return $this->redirect('wechat.response.index',$wechatResponse->wechat_id)->with('success', '更新成功.');
	}

    /**
     * 删除
     *
     * @param WechatResponse $wechatResponse
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function destroy(WechatResponse $wechatResponse)
	{
		$this->authorize('destroy', $wechatResponse);

		$wechatResponse->delete();

		return $this->redirect()->with('success', '删除成功.');
	}

    /**
     * 订阅
     *
     * @param Wechat $wechat
     * @param string $group
     * @return mixed
     */
	public function setResponse(Wechat $wechat, $group = 'subscribe'){
        $wechat_response = WechatResponse::where('group',$group)->where('wechat_id', $wechat->id)->first() ?? new WechatResponse;

        return backend_view('wechat.response.create_and_edit', compact('wechat_response','wechat', 'group'));
    }

    /**
     * 订阅保存
     *
     * @param WechatResponseRequest $request
     * @param Wechat $wechat
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setResponseStore(WechatResponseRequest $request, Wechat $wechat){
        if($wechatResponse = WechatResponse::where('group',$request->group)->where('wechat_id', $wechat->id)->first()){
            $wechatResponse = $wechatResponse->update($request->all());
        }else{
            $wechatResponse = WechatResponse::create($request->all());
        }

        return redirect()->route('wechats.index')->with('success', '保存成功.');
    }
}