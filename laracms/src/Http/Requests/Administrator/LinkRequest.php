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

class LinkRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required|max:32',
            'url' => 'required|url|max:191',
            'target' => 'required|'.Rule::in(['_blank','_self']),
            'rating' => 'nullable|integer|max:255',
            'order' => 'nullable|integer',
            'rel' => 'nullable|max:255',
            'description' => 'nullable|max:191',
            'status' => 'nullable|'.Rule::in(['0','1']),
        ];

    }
    
}
