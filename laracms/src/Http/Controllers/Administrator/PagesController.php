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

use Wanglelecc\Laracms\Models\Page;
use Illuminate\Http\Request;
use Wanglelecc\Laracms\Http\Requests\Administrator\PageRequest;

/**
 * 页面控制器
 *
 * Class PagesController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class PagesController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.page';
    }
    
    /**
     * 列表
     *
     * @param Page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Page $page)
    {
        $this->authorize('index', $page);

        $pages = $page->ordered()->recent()->paginate(config('administrator.paginate.limit'));

        return backend_view('pages.index', compact('pages'));
    }

    /**
     * 详情
     *
     * @param Page $page
     * @return mixed
     */
    public function show(Page $page)
    {
        return backend_view('pages.show', compact('page'));
    }

    /**
     * 创建
     *
     * @param Page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Page $page)
    {
        $this->authorize('create', $page);

        return backend_view('pages.create_and_edit', compact('page'));
    }

    /**
     * 保存
     *
     * @param PageRequest $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(PageRequest $request, Page $page)
    {
        $this->authorize('create', $page);

        $page = Page::create($request->all());

        return $this->redirect('pages.index')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param Page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Page $page)
    {
        $this->authorize('update', $page);

        return backend_view('pages.create_and_edit', compact('page'));
    }

    /**
     * 更新
     *
     * @param PageRequest $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(PageRequest $request, Page $page)
    {
        $this->authorize('update', $page);

        $page->update($request->all());

        return $this->redirect('pages.index')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Page $page)
    {
        $this->authorize('destroy', $page);
        
//        var_dump($page->isDestroy()); exit;
        if( !$page->isDestroy() ){ // danger
            return $this->redirect()->with('message', '导航已使用，无法删除！');
        }

        $page->delete();

        return $this->redirect()->with('success', '删除成功.');
    }
}