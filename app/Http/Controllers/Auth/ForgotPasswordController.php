<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return frontend_view('auth.passwords.email');
    }


    protected function validateEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'captcha' => 'required|captcha',
         ],[
            'captcha.required' => '验证码不能为空.',
            'captcha.captcha' => '验证码错误.',
        ]);
    }
}
