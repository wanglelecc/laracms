<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\WechatRequest;

class WechatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$wechats = Wechat::paginate(config('administrator.paginate.limit'));
		return backend_view('wechats.index', compact('wechats'));
	}

    public function show(Wechat $wechat)
    {
        return backend_view('wechats.show', compact('wechat'));
    }

	public function create(Wechat $wechat)
	{
		return backend_view('wechats.create_and_edit', compact('wechat'));
	}

	public function store(WechatRequest $request)
	{
		$wechat = Wechat::create($request->all());
		return redirect()->route('wechats.index')->with('success', '添加成功.');
	}

	public function edit(Wechat $wechat)
	{
        $this->authorize('update', $wechat);
		return backend_view('wechats.create_and_edit', compact('wechat'));
	}

	public function update(WechatRequest $request, Wechat $wechat)
	{
		$this->authorize('update', $wechat);
		$wechat->update($request->all());

		return redirect()->route('wechats.index')->with('success', '更新成功.');
	}

	public function destroy(Wechat $wechat)
	{
		$this->authorize('destroy', $wechat);
		$wechat->delete();

		return redirect()->route('wechats.index')->with('success', '删除成功.');
	}

	// 接入
	public function integrate(Wechat $wechat){
        $this->authorize('show', $wechat);
        return backend_view('wechats.integrate', compact('wechat'));
    }

    // 设置响应
    public function setResponse($type = 'default'){

    }

    // 订阅响应

}