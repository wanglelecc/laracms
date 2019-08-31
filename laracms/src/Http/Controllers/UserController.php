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

namespace Wanglelecc\Laracms\Http\Controllers;

use Auth;
use Hash;
use Wanglelecc\Laracms\Models\User;
use Illuminate\Http\Request;
use Wanglelecc\Laracms\Handlers\UploadHandler;
use Wanglelecc\Laracms\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * 前台用户控制器
 *
 * Class UserController
 * @package Wanglelecc\Laracms\Http\Controllers
 */
class UserController extends Controller
{

    /**
     * 用户中心
     *
     * @return mixed
     */
    public function index()
    {
        return frontend_view('user.index');
    }

    /**
     * 激活邮箱
     *
     * @param User $user
     * @return mixed
     */
    public function activate(User $user){
        $user = Auth::user();
        return frontend_view('user.activate', compact('user'));
    }

    /**
     * 我的主页
     *
     * @param User $user
     * @return mixed
     */
    public function home(User $user){
        return frontend_view('user.home', compact('user'));
    }

    /**
     * 基本设置
     *
     * @return mixed
     */
    public function settings()
    {
        $user = Auth::user();
        return frontend_view('user.settings', compact('user'));
    }

    /**
     * 我的消息
     *
     * @return mixed
     */
    public function messages()
    {
        $user = Auth::user();
        // 获取登录用户的所有通知
        $notifications = $user->notifications()->paginate(20);
        // 标记为已读，未读数量清零
        Auth::user()->markAsRead();
        return frontend_view('user.messages',compact('user', 'notifications'));
    }

    /**
     * 更新用户资料
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function updateInfo(UserRequest $request)
    {
        $user = Auth::user();
        $data = $request->only('sex','introduction');
        if( !$user->phone ){

            $verifyData = \Cache::get('verificationCode_'.trim($request->phone));

            if (!$verifyData) {
                throw ValidationException::withMessages([
                    'phone' => ['验证码已失效'],
                ]);
            }

            if (!hash_equals($verifyData['code'], $request->verification_code)) {
                // 返回401
                throw ValidationException::withMessages([
                    'phone' => ['验证码错误'],
                ]);
            }

            \Cache::forget('verificationCode_'.trim($request->phone));

            $data['phone'] = $verifyData['phone'];
        }

        if($request->email != $user->email){
            $data['email_is_activated'] = '0';
            $data['email_activated_time'] = null;
        }

        $user->update($data);
        return redirect()->route('user.settings','#info')->with('success', '资料更新成功！');
    }

    /**
     * 更新用户头像
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAvatar(Request $request)
    {
        $user = Auth::user();
        $data = $request->only('avatar');

        $user->update($data);
        return redirect()->route('user.settings','#avatar')->with('success', '头像更新成功！');
    }

    /**
     * 更新密码
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request){
        $user = Auth::user();
        $this->passwordValidator($data = $request->all());

        if( $request->password == $request->old_password ){
            return redirect()->back()->withInput()->withErrors('新密码不可与原密码一致！');
        }

        if( !$this->confirmedOldPassword($user, $request->old_password) ){
            return redirect()->back()->withInput()->withErrors('原密码错误！');
        }

        $user->update(['password'=>$request->password]);
        return redirect()->route('user.settings','#pass')->with('success', '密码更新成功！');
    }

    /**
     * 更新密码验证
     *
     * @param $data
     */
    protected function passwordValidator($data){
        Validator::make($data, [
            'old_password' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ],[
            'password.min' => '新密码至少为6位',
            'password.confirmed' => '确认密码与新密码不一致.',
        ])->validate();
    }

    /**
     * 检查原密码是否正确
     *
     * @param User $user
     * @param $old_password
     * @return mixed
     */
    protected function confirmedOldPassword(User $user, $old_password){
        return Hash::check($old_password, $user->password);
    }

}
