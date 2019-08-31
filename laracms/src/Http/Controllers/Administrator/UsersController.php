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

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
//use Wanglelecc\Laracms\Models\User;
use Illuminate\Support\Facades\Validator;
use Wanglelecc\Laracms\Http\Requests\Administrator\UserRequest;
use Wanglelecc\Laracms\Handlers\UploadHandler;


/**
 * 用户控制器
 *
 * Class UsersController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class UsersController extends Controller
{
    public function __construct()
    {
        static::$activeNavId = 'system.users';
    }
    
    /**
     * 列表
     *
     * @param Request $request
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('manage', $user);

        $users = $user->withOrder($request->sortField, $request->sortOrder)->paginate(config('administrator.paginate.limit'));

        return backend_view('users.index', compact('users'));
    }

    /**
     * 创建
     *
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(User $user)
    {
        $this->authorize('create', $user);

        $roles = Role::get()->pluck('name', 'remarks')->toArray();
        $userRoles = [];

        return backend_view('users.create_and_edit', compact('user','roles', 'userRoles'));
    }

    /**
     * 保存
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(UserRequest $request, User $user)
    {
        $this->authorize('create', $user);

        $data = $request->only(['name','email','password','introduction','status']);
        $user = User::create($data);
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        return redirect()->route('users.index')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::get()->pluck('name', 'remarks')->toArray();
        $userRoles = $user->roles()->get();
        $userRoles = $user->roles()->pluck('name', 'name')->toArray();
        
        return backend_view('users.create_and_edit', compact('user','roles', 'userRoles'));
    }

    /**
     * 更新
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return $this->redirect('users.index')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);

        $user->delete();
        return $this->redirect()->with('success', '删除成功.');
    }

    /**
     * 修改密码
     *
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
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
