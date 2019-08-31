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
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Wanglelecc\Laracms\Handlers\CategoryHandler;


/**
 * 权限控制器
 *
 * Class PermissionsController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class PermissionsController extends Controller
{
    public function __construct()
    {
        static::$activeNavId = 'system.permissions';
    }
    
    /**
     * 列表
     *
     * @param Request         $request
     * @param Permission      $permission
     * @param CategoryHandler $categoryHandler
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, Permission $permission, CategoryHandler $categoryHandler)
    {
        $this->authorize('index', $permission);
        
        $permissions = $permission->orderBy('order', 'desc')->orderBy('id', 'asc')->get();
        
        if($permissions){
            $permissions = $categoryHandler->level($permissions);
        }
        
        return backend_view('permissions.index', compact('permissions'));
    }

    /**
     * 详情
     *
     * @param Permission $permission
     * @return mixed
     */
    public function show(Permission $permission)
    {
        return backend_view('permissions.show', compact('permission'));
    }
    
    /**
     * 创建
     *
     * @param Permission      $permission
     * @param CategoryHandler $categoryHandler
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Permission $permission, CategoryHandler $categoryHandler)
    {
        $this->authorize('create', $permission);
    
        $parent = request('parent', 0);
        
        $permissions = $permission->select('id','remarks AS name','parent','order')->orderBy('order', 'desc')->orderBy('id', 'asc')->get();
        
        if($permissions){
            $permissions = $categoryHandler->select($permissions);
        }
        
        return backend_view('permissions.create_and_edit', compact('permissions','permission', 'parent'));
    }

    /**
     * 保存
     *
     * @param Request $request
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Permission $permission)
    {
        $this->authorize('create', $permission);
        
        Permission::create($request->only(['name','remarks', 'parent']));
        
        return $this->redirect('permissions.index')->with('success', '添加成功.');
    }
    
    /**
     * 编辑
     *
     * @param Permission      $permission
     * @param CategoryHandler $categoryHandler
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Permission $permission, CategoryHandler $categoryHandler)
    {
        $this->authorize('update', $permission);
        
        $permissions = $permission->select('id','remarks AS name','parent','order')->orderBy('order', 'desc')->orderBy('id', 'asc')->get();
        
        if($permissions){
            $permissions = $categoryHandler->select($permissions);
        }

        $parent = $permission->parent ?? 0;

        return backend_view('permissions.create_and_edit', compact('permissions','permission', 'parent'));
    }

    /**
     * 更新
     *
     * @param Request $request
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);

        $permission->update($request->only(['parent', 'name','remarks']));

        return $this->redirect('permissions.index')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('destroy', $permission);

        $permission->delete();

        return $this->redirect()->with('success', '删除成功.');
    }
    
    /**
     * 排序
     *
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function order(Permission $permission){
        
        $this->authorize('update', $permission);
        
        $ids = request('id',[]);
        
        $order = request('order',[]);
        
        foreach($ids as $k => $id){
            $permission->where('id', $id)->update(['order' => $order[$k] ?? 0 ]);
        }
        
        return redirect()->route('permissions.index')->with('success', '操作成功.');
    }
}
