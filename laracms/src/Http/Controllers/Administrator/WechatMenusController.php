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
use Wanglelecc\Laracms\Models\WechatMenu;
use Illuminate\Http\Request;
use Wanglelecc\Laracms\Http\Requests\Administrator\WechatMenuRequest;
use Wanglelecc\Laracms\Handlers\WechatMenuHandler;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Exceptions\HttpException;

/**
 * 微信菜单控制器
 *
 * Class WechatMenusController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class WechatMenusController extends Controller
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
     * @param WechatMenuHandler $handler
     * @return mixed
     */
	public function index(Wechat $wechat, WechatMenuHandler $handler)
	{
        $wechat_menus = collect($handler->level(WechatMenu::where('group',$wechat->id)->ordered()->recent('asc')->get()));
		return backend_view('wechat.menus.index', compact('wechat_menus', 'wechat'));
	}

    /**
     * 详情
     *
     * @param WechatMenu $wechat_menu
     * @return mixed
     */
    public function show(WechatMenu $wechat_menu)
    {
        return backend_view('wechat.menus.show', compact('wechat_menu'));
    }

    /**
     * 创建
     *
     * @param WechatMenu $wechat_menu
     * @param Wechat $wechat
     * @param int $parent
     * @return mixed
     */
	public function create(WechatMenu $wechat_menu, Wechat $wechat, $parent = 0)
	{
		return backend_view('wechat.menus.create_and_edit', compact('wechat_menu', 'wechat', 'parent'));
	}

    /**
     * 保存
     *
     * @param WechatMenuRequest $request
     * @param Wechat $wechat
     * @return \Illuminate\Http\RedirectResponse
     */
	public function store(WechatMenuRequest $request, Wechat $wechat)
	{
		$wechat_menu = WechatMenu::create($request->all());

		return $this->redirect('wechat.menus.index',$wechat)->with('success', '添加成功.');
	}

    /**
     * 编辑
     *
     * @param WechatMenu $wechat_menu
     * @param Wechat $wechat
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function edit(WechatMenu $wechat_menu, Wechat $wechat)
	{
        $this->authorize('update', $wechat_menu);

        $parent = $wechat_menu->parent;

        return backend_view('wechat.menus.create_and_edit', compact('wechat_menu','wechat', 'parent'));
	}

    /**
     * 更新
     *
     * @param WechatMenuRequest $request
     * @param WechatMenu $wechat_menu
     * @param Wechat $wechat
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function update(WechatMenuRequest $request, WechatMenu $wechat_menu,  Wechat $wechat)
	{
		$this->authorize('update', $wechat_menu);

		$wechat_menu->update($request->all());

		return $this->redirect('wechat.menus.index',$wechat->id)->with('success', '更新成功.');
	}

    /**
     * 删除
     *
     * @param WechatMenu $wechat_menu
     * @param Wechat $wechat
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function destroy(WechatMenu $wechat_menu, Wechat $wechat)
	{
		$this->authorize('destroy', $wechat_menu);

		$wechat_menu->delete();

		return $this->redirect()->with('success', '删除成功.');
	}

    /**
     * 排序
     *
     * @param WechatMenu $wechat_menu
     * @param $wechat
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function order(WechatMenu $wechat_menu, $wechat){
        $this->authorize('update', $wechat_menu);

        $ids = request('id',[]);
        $order = request('order',[]);

        foreach($ids as $k => $id){
            $wechat_menu->where('id',$id)->update(['order' => $order[$k] ?? 999 ]);
        }

        return redirect()->route('wechat.menus.index', $wechat)->with('success', '操作成功.');
    }

    /**
     * 同步到微信服务器
     *
     * @param Wechat $wechat
     * @param WechatMenuHandler $handler
     * @return \Illuminate\Http\RedirectResponse
     */
    public function synchronizeWechatServer(Wechat $wechat, WechatMenuHandler $handler){

        $buttons = $handler->withRecursionWeixinServer(WechatMenu::where('group',$wechat->id)->ordered()->recent('asc')->get());

        try{
            $app = Factory::officialAccount(['app_id'=>$wechat->app_id,'secret'=>$wechat->app_secret]);
            $result = $app->menu->create($buttons);
        }catch (HttpException $exception){
            return redirect()->route('wechat.menus.index',$wechat->id)->with('danger', '同步失败！原因：'.$exception->getMessage().'');
        }

        if($result['errcode'] == 0){
            return redirect()->route('wechat.menus.index',$wechat->id)->with('success', '成功同步到微信服务器.');
        }else{
            return redirect()->route('wechat.menus.index',$wechat->id)->with('danger', '同步失败！原因('.$result['errcode'].')：'.$result['errmsg']);
        }
    }
}