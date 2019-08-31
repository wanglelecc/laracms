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

namespace Wanglelecc\Laracms\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Wanglelecc\Laracms\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Wanglelecc\Laracms\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function showLoginForm()
    {
        return frontend_view('auth.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'redirectToProvider', 'handleProviderCallback', 'unbind');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha',
        ],[
            'captcha.required' => '验证码不能为空.',
            'captcha.captcha' => '验证码错误.',
        ]);
    }


    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['status' => 2]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($type)
    {
        if ($this->checkOauthType($type)) {
            return abort(404);
        }

        return Socialite::with($type)->redirect();
//        return Socialite::driver($type)->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($type)
    {
        if ($this->checkOauthType($type)) {
            return abort(404);
        }

        $oauthUser = Socialite::driver($type)->stateless()->user();

//        $user = $driver->user();
        switch (strtolower($type)) {
            case 'weixin':
                $unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;

                if ($unionid) {
                    $user = User::where('weixin_unionid', $unionid)->first();
                } else {
                    $user = User::where('weixin_openid', $oauthUser->getId())->first();
                }

                $userAttributes = [
                    'weixin_unionid' => $unionid,
                    'weixin_openid' => $oauthUser->getId(),
                ];
                break;

            case 'weibo':
                $user = User::where('weibo_id', $oauthUser->getId())->first();
                $userAttributes = [
                    'weibo_id' => $oauthUser->getId(),
                ];
                break;

            case 'qq':
                $user = User::where('qq_id', $oauthUser->getId())->first();
                $userAttributes = [
                    'qq_id' => $oauthUser->getId(),
                ];
                break;

            case 'github':
                $user = User::where('github_id', $oauthUser->getId())->first();
                $userAttributes = [
                    'github_id' => $oauthUser->getId(),
                ];
                break;
        }

        // 没有用户且未登录，默认创建一个用户
        if (!$user && !Auth::check()) {
            $user = User::create(array_merge([
                'name' => $oauthUser->getNickname(),
//                'name' => 'lara_'.create_object_id(),
                'avatar' => $oauthUser->getAvatar(),
            ],$userAttributes));
        }else if(!$user && Auth::check()){
            // 没有用户但是已登录，默认绑定
            $user = Auth::user();
            $user->update($userAttributes);
//            $user->fill($userAttributes);
//            $user->save();
            return redirect()->route('user.settings','#bind')->with('success', '绑定成功.');
        }else if($user && Auth::check() && ($user->id != Auth::user()->id) ){
            return redirect()->route('user.settings','#bind')->with('danger', '已绑定过其它用户，不能重复绑定.');
        }else if( $user && Auth::check() && ($user->id == Auth::user()->id) ){
            return redirect()->route('user.settings','#bind')->with('danger', '已绑定，无需重复绑定.');
        }

        # 登录用户
        Auth::login($user);
//        return redirect()->route('user.settings','#info')->with('success', '成功登录.');
        return redirect()->route('user.settings','#info');

//        dd($oauthUser);

        // $user->token;
    }

    public function unbind($type){

        if ($this->checkOauthType($type)) {
            return abort(404);
        }

        $user = Auth::user();

        if(!$user->email){
            return redirect()->route('user.settings','#bind')->with('danger', '绑定邮箱后才能解绑.');
        }

        switch (strtolower($type)) {
            case 'weixin':
                $userAttributes = [
                    'weixin_unionid' => null,
                    'weixin_openid' => null,
                ];
                break;

            case 'weibo':
                $userAttributes = [
                    'weibo_id' => null,
                ];
                break;

            case 'qq':
                $userAttributes = [
                    'qq_id' => null,
                ];
                break;

            case 'github':
                $userAttributes = [
                    'github_id' => null,
                ];
                break;
        }

        # 用户保存
        $user->update($userAttributes);
//        $user->fill($userAttributes);
//        $user->save();

        return redirect()->route('user.settings','#bind')->with('success', '解绑成功.');
    }

    protected function checkOauthType($type){
        return !in_array($type, ['weixin','weixinweb','qq','weibo','github']);
    }
}
