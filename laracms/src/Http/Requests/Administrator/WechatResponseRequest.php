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

class WechatResponseRequest extends Request
{
    public function rules()
    {
        return [
            // CREATE ROLES
            'wechat_id' => 'required|integer',
            'type' => 'required|'.Rule::in(['text','link','news']),
            'key' => 'required|min:1|max:128',
            'group' => 'required|string|min:1|max:128',
            'content' => 'required|array',
        ];
    }
    
}
