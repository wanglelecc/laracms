<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Wechat;
use App\Models\WechatResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\WechatResponseRequest;

class WechatResponseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Wechat $wechat)
	{
		$wechat_responses = WechatResponse::where('wechat_id',$wechat->id)->recent('asc')->paginate(config('administrator.paginate.limit'));
		return backend_view('wechat_response.index', compact('wechat_responses', 'wechat'));
	}

    public function show(WechatResponse $wechatResponse, Wechat $wechat)
    {
        return backend_view('wechat_response.show', compact('wechatResponse','wechat'));
    }

	public function create(WechatResponse $wechat_response, Wechat $wechat)
	{
		return backend_view('wechat_response.create_and_edit', compact('wechat_response','wechat'));
	}

	public function store(WechatResponseRequest $request, Wechat $wechat)
	{
        $wechatResponse = WechatResponse::create($request->all());
		return redirect()->route('wechat_response.index',$wechat->id)->with('success', '添加成功.');
	}

	public function edit(WechatResponse $wechat_response, Wechat $wechat)
	{
        $this->authorize('update', $wechat_response);
		return backend_view('wechat_response.create_and_edit', compact('wechat_response','wechat'));
	}

	public function update(WechatResponse $wechatResponse, WechatResponseRequest $request)
	{
		$this->authorize('update', $wechatResponse);
        $wechatResponse->update($request->all());

		return redirect()->route('wechat_response.index',$wechatResponse->wechat_id)->with('success', '更新成功.');
	}

	public function destroy(WechatResponse $wechatResponse)
	{
		$this->authorize('destroy', $wechatResponse);
		$wechat_id = $wechatResponse->wechat_id;
		$wechatResponse->delete();

		return redirect()->route('wechat_response.index',$wechat_id)->with('success', '删除成功.');
	}

	// 订阅
	public function setResponse(Wechat $wechat, $group = 'subscribe'){
        $wechat_response = WechatResponse::where('group',$group)->where('wechat_id', $wechat->id)->first() ?? new WechatResponse;
//        $this->authorize('update', $wechat_response);
        return backend_view('wechat_response.create_and_edit', compact('wechat_response','wechat', 'group'));
    }

    //
    public function setResponseStore(WechatResponseRequest $request, Wechat $wechat){
        if($wechatResponse = WechatResponse::where('group',$request->group)->where('wechat_id', $wechat->id)->first()){
            $wechatResponse = $wechatResponse->update($request->all());
        }else{
            $wechatResponse = WechatResponse::create($request->all());
        }

        return redirect()->route('wechats.index')->with('success', '保存成功.');
    }
}