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

use Wanglelecc\Laracms\Http\Requests\Administrator\CategoryRequest;
use Wanglelecc\Laracms\Models\Category;
use Wanglelecc\Laracms\Handlers\CategoryHandler;
use Illuminate\Http\Request;

/**
 * 分类控制器
 *
 * Class CategorysController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class CategorysController extends Controller
{
    public function __construct(Request $request)
    {
        $type = ($request->route('type'));
        static::$activeNavId = 'content.category.'.$type;
    }
    
    /**
     * 列表
     *
     * @param $type
     * @param Category $category
     * @param CategoryHandler $categoryHandler
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index( $type, Category $category, CategoryHandler $categoryHandler){
        $this->authorize('index', $category);

        $categorys = $category->ordered()->recent('asc')->where('type','=', $type)->get();
        if($categorys){
            $categorys = $categoryHandler->level($categorys);
        }

        $view = backend_view_exists("category.index_{$type}") ? backend_view("category.index_{$type}") : backend_view('category.index');

        return $view->with(compact(['type','categorys']));
    }

    /**
     * 创建
     *
     * @param $type
     * @param int $parent
     * @param Category $category
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create($type, $parent = 0, Category $category){
        $this->authorize('create', $category);

        $view = backend_view_exists("category.create_and_edit_{$type}") ? backend_view("category.create_and_edit_{$type}") : backend_view('category.create_and_edit');

        return $view->with(compact(['type','parent','category']));
    }

    /**
     * 保存
     *
     * @param $type
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store($type, CategoryRequest $request, Category $category){
        $this->authorize('create', $category);

        $category = Category::create($request->all());

        return $this->redirect('administrator.category.index',$type)->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param Category $category
     * @param $type
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Category $category, $type){
        $this->authorize('update', $category);

        $view = backend_view_exists("category.create_and_edit_{$type}") ? backend_view("category.create_and_edit_{$type}") : backend_view('category.create_and_edit');
        $parent = $category->parent;

        return $view->with(compact(['category','type','parent']));
    }

    /**
     * 更新
     *
     * @param Category $category
     * @param $type
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Category $category, $type, CategoryRequest $request){
        $this->authorize('update', $category);

        $category->update($request->all());

        return $this->redirect('administrator.category.index',$type)->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param Category $category
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Category $category, $type){
        $this->authorize('destroy', $category);
        
        if( is_string($message = $category->isDestroy()) ){
            return $this->redirect()->with('message', $message);
        }

        $category->delete();

        return $this->redirect()->with('success', '删除成功.');
    }

    /**
     * 排序
     *
     * @param Category $category
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function order(Category $category, $type){
        $this->authorize('update', $category);

        $ids = request('id',[]);
        $order = request('order',[]);

        foreach($ids as $k => $id){
            $category->where('id',$id)->update(['order' => $order[$k] ?? 999 ]);
        }

        return redirect()->route('administrator.category.index', $type)->with('success', '操作成功.');
    }
}
