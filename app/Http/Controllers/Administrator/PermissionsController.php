<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    public function index(Request $request, Permission $permission)
    {
        $this->authorize('index', $permission);
        $permissions = $permission->paginate(config('administrator.paginate.limit'));
        return backend_view('permissions.index', compact('permissions'));
    }

    public function show(Permission $permission)
    {
        return backend_view('permissions.show', compact('permission'));
    }

    public function create(Permission $permission)
    {
        $this->authorize('create', $permission);
        return backend_view('permissions.create_and_edit', compact('permission'));
    }

    public function store(Request $request, Permission $permission)
    {
        $this->authorize('create', $permission);
        $user = Permission::create($request->only(['name','remarks']));
        return redirect()->route('permissions.index')->with('success', '添加成功.');
    }

    public function edit(Permission $permission)
    {
        $this->authorize('update', $permission);
        return backend_view('permissions.create_and_edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);
        $permission->update($request->only(['name','remarks']));

        return redirect()->route('permissions.index')->with('success', '更新成功.');
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('destroy', $permission);
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', '删除成功.');
    }
}
