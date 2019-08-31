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

namespace Wanglelecc\Laracms\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class WechatRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    // CREATE ROLES
                    'type' => 'required|'.Rule::in(['subscribe','service']),
                    'name' => 'required|min:1|max:64',
                    'account' => 'required|min:1|max:30',
                    'app_id' => 'required|min:1|max:30',
                    'app_secret' => 'required|min:1|max:32',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'type' => 'required|'.Rule::in(['subscribe','service']),
                    'name' => 'required|min:1|max:64',
                    'account' => 'required|min:1|max:30',
                    'app_id' => 'required|min:1|max:30',
                    'app_secret' => 'required|min:1|max:32',
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
