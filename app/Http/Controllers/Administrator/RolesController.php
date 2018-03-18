<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function index(Request $request, Role $role)
    {
        $this->authorize('index', $role);
        $roles = $role->paginate(config('administrator.paginate.limit'));
        return backend_view('roles.index', compact('roles'));
    }

    public function show(Role $role)
    {
        return backend_view('roles.show', compact('role'));
    }

    public function create(Role $role)
    {
        $this->authorize('create', $role);
        $permissions = Permission::get()->pluck('name','remarks');
        $rolePermissions = [];

        return backend_view('roles.create_and_edit', compact('role','permissions','rolePermissions'));
    }

    public function store(Request $request, Role $role)
    {
        $this->authorize('create', $role);
        $role = Role::create($request->only(['name','remarks']));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->givePermissionTo($permissions);

        return redirect()->route('roles.index')->with('success', '添加成功.');
    }

    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        $permissions = Permission::get()->pluck('name','remarks')->toArray();
        $rolePermissions = $role->permissions()->pluck('name', 'name')->toArray();

        return backend_view('roles.create_and_edit', compact('role','permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);
        $role->update($request->only(['name','remarks']));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', '更新成功.');
    }

    public function destroy(Role $role)
    {
        $this->authorize('destroy', $role);
        $role->delete();
        return redirect()->route('roles.index')->with('success', '删除成功.');
    }



}
