<?php

namespace App\Http\Controllers\Administrator;

use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Administrator\UserRequest;
use App\Handlers\UploadHandler;
use Spatie\Permission\Models\Role;


class UsersController extends Controller
{

    public function index(Request $request, User $user)
    {
        $this->authorize('manage', $user);

        $users = $user->withOrder($request->sortField, $request->sortOrder)->paginate(config('administrator.paginate.limit'));
        return backend_view('users.index', compact('users'));
    }

    public function create(User $user)
    {
        $this->authorize('create', $user);
        $roles = Role::get()->pluck('name', 'remarks')->toArray();
        $userRoles = [];
        return backend_view('users.create_and_edit', compact('user','roles', 'userRoles'));
    }

    public function store(UserRequest $request, User $user)
    {
        $this->authorize('create', $user);
        $data = $request->only(['name','email','password','introduction','status']);
        $user = User::create($data);
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        return redirect()->route('users.index')->with('success', '添加成功.');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles = Role::get()->pluck('name', 'remarks')->toArray();
        $userRoles = $user->roles()->pluck('name', 'name')->toArray();
        return backend_view('users.create_and_edit', compact('user','roles', 'userRoles'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', '更新成功.');
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        return redirect()->route('users.index')->with('success', '删除成功.');
    }

    /**
     * 修改密码
     */
    public function showPasswordForm(User $user){
        $this->authorize('update', $user);
        return backend_view('users.password',compact('user'));
    }

    /**
     * 更新密码
     *
     * @param Request $request
     * @param User $user
     * @return $this
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function passwordRequestForm(Request $request, User $user){
        $this->authorize('update', $user);
        $this->passwordValidator($data = $request->all());

        $user->update(['password'=>$request->password]);
        return redirect()->route('users.index')->with('success', '密码重置成功！');
    }

    /**
     * 更新密码验证
     *
     * @param $data
     */
    protected function passwordValidator($data){
        Validator::make($data, [
            'password' => 'required|string|min:6|confirmed',
        ],[
            'password.min' => '新密码至少为6位',
            'password.confirmed' => '确认密码与新密码不一致.',
        ])->validate();
    }
}
