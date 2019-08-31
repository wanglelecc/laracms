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

namespace Wanglelecc\Laracms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name',
                        'email' => 'required|email|unique:users,email',
                        'introduction' => 'max:80',
                        'avatar' => 'max:150',
                        'sex' => 'required|'.Rule::in(['0','1']),
                        'phone' => 'nullable|regex:/^1[3456789]\d{9}$/|unique:users',
                    ];
                }
            // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::user()->id,
                        'email' => 'required|email|unique:users,email,' . Auth::user()->id,
                        'introduction' => 'max:80',
                        'avatar' => 'max:150',
                        'sex' => 'required|'.Rule::in(['0','1']),
                        'phone' => 'nullable|regex:/^1[3456789]\d{9}$/|unique:users,phone,'. Auth::user()->id,
                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                };
        }
    }
}
