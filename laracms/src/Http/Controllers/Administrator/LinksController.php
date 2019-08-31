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

use Wanglelecc\Laracms\Models\Link;
use Illuminate\Http\Request;
use Wanglelecc\Laracms\Http\Requests\Administrator\LinkRequest;

/**
 * 友情链接
 *
 * Class LinksController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class LinksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    
        static::$activeNavId = 'website.link';
    }

    /**
     * 列表
     *
     * @param Request $request
     * @param Link $link
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function index(Request $request, Link $link)
	{
	    $this->authorize('index',$link);

	    $links = $link->ordered()->recent()->paginate((config('administrator.paginate.limit')));

		return backend_view('links.index', compact('links'));
	}

    /**
     * 详情
     *
     * @param Link $link
     * @return mixed
     */
    public function show(Link $link)
    {
        return backend_view('links.show', compact('link'));
    }

    /**
     * 创建
     *
     * @param Link $link
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function create(Link $link)
	{
        $this->authorize('create',$link);

        return backend_view('links.create_and_edit', compact('link'));
	}

    /**
     * 保存
     *
     * @param LinkRequest $request
     * @param Link $link
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function store(LinkRequest $request, Link $link)
	{
        $this->authorize('create',$link);

        $link = Link::create($request->all());

        return redirect()->route('links.index')->with('success', '添加成功.');
	}

    /**
     * 编辑
     *
     * @param Link $link
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function edit(Link $link)
	{
        $this->authorize('update', $link);

        return backend_view('links.create_and_edit', compact('link'));
	}

    /**
     * 更新
     *
     * @param LinkRequest $request
     * @param Link $link
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function update(LinkRequest $request, Link $link)
	{
		$this->authorize('update', $link);

		$link->update($request->all());

		return $this->redirect('links.index')->with('success', '更新成功.');
	}

    /**
     * 删除
     *
     * @param Link $link
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function destroy(Link $link)
	{
		$this->authorize('destroy', $link);
		$link->delete();

		return $this->redirect()->with('success', '删除成功.');
	}
}