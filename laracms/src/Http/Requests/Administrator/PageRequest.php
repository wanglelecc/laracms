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

class PageRequest extends Request
{
    public function rules()
    {

        return [
            'title' => 'required|min:1|max:191',
            'keywords' => 'nullable|max:191',
            'description' => 'nullable|max:191',
            'author' => 'nullable|max:191',
            'source' => 'nullable|max:191',
            'category_id' => 'nullable|integer',
            'content' => 'required|min:1|max:65535',
            'thumb' => 'nullable|max:191',
            'order' => 'nullable|integer',
            'status' => 'nullable|integer',
            'views' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'top' => 'nullable|'.Rule::in(['0','1']),
            'link' => 'nullable|alpha_dash|unique:article|max:191',
            'template' => 'nullable|alpha_dash|max:191',
        ];

    }


}
