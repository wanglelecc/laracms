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

use Illuminate\Http\Request;
use Wanglelecc\Laracms\Http\Requests\Administrator\NavigationRequest;
use Illuminate\Support\Facades\View;
use Wanglelecc\Laracms\Models\Navigation;
use Wanglelecc\Laracms\Handlers\NavigationHandler;

/**
 * 导航控制器
 *
 * Class NavigationsController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class NavigationsController extends Controller
{
    public function __construct()
    {
        static::$activeNavId = 'website.navigation';
    }
    
    /**
     * 列表
     *
     * @param $category
     * @param Navigation $navigation
     * @param NavigationHandler $navigationHandler
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index( $category, Navigation $navigation, NavigationHandler $navigationHandler){
        $this->authorize('index', $navigation);

        $navigations = $navigation->ordered()->recent('asc')->where('category','=', $category)->get();
        if($navigations){
            $navigations = $navigationHandler->level($navigations);
        }

        $view = backend_view_exists("navigation.index_{$category}") ? backend_view("navigation.index_{$category}") : backend_view('navigation.index');

        return $view->with(compact(['category','navigations']));
    }

    /**
     * 创建
     *
     * @param $category
     * @param int $parent
     * @param Navigation $navigation
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create($category, $parent = 0, Navigation $navigation){
        $this->authorize('create', $navigation);

        $view = backend_view_exists("navigation.create_and_edit_{$category}") ? backend_view("navigation.create_and_edit_{$category}") : backend_view('navigation.create_and_edit');

        return $view->with(compact(['category','parent','navigation']));
    }

    /**
     * 保存
     *
     * @param $category
     * @param NavigationRequest $request
     * @param Navigation $navigation
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store($category, NavigationRequest $request, Navigation $navigation){
        $this->authorize('create', $navigation);

        $navigation = Navigation::create($request->all());

        return $this->redirect('administrator.navigation.index',$category)->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param Navigation $navigation
     * @param $category
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Navigation $navigation, $category){
        $this->authorize('update', $navigation);

        $view = backend_view_exists("navigation.create_and_edit_{$category}") ? backend_view("navigation.create_and_edit_{$category}") : backend_view('navigation.create_and_edit');
        $parent = $navigation->parent;

        return $view->with(compact(['navigation','category','parent']));
    }

    /**
     * 更新
     *
     * @param Navigation $navigation
     * @param $category
     * @param NavigationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Navigation $navigation, $category, NavigationRequest $request){

        $this->authorize('update', $navigation);

        $navigation->update($request->all());

        return $this->redirect('administrator.navigation.index',$category)->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param Navigation $navigation
     * @param $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Navigation $navigation, $category){
        $this->authorize('destroy', $navigation);

        $navigation->delete();

        return $this->redirect()->with('success', '删除成功.');
    }

    /**
     * 排序
     *
     * @param Navigation $navigation
     * @param $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function order(Navigation $navigation, $category){
        $this->authorize('update', $navigation);

        $ids = request('id',[]);
        $order = request('order',[]);

        foreach($ids as $k => $id){
            $navigation->where('id',$id)->update(['order' => $order[$k] ?? 999 ]);
        }

        return redirect()->route('administrator.navigation.index', $category)->with('success', '操作成功.');
    }
}
