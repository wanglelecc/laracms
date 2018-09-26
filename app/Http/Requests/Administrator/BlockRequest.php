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

namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class BlockRequest extends Request
{
    public function rules()
    {

        return [
            'type' => 'required|'.Rule::in(array_keys(config('blocks.types'))),
            'title' => 'required|min:1|max:255',
            'more_title' => 'nullable|max:255',
            'more_link' => 'nullable|max:255',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => '类型不能为空.',
            'title.required' => '名称不能为空.',
            'title.max' => '名称不能超过255个字符.',
            'more_title.required' => '更多链接标题不能为空.',
            'more_title.max' => '更多链接标题不能超过255个字符.',
            'more_link.required' => '更多链接地址不能为空.',
            'more_link.url' => '更多链接地址必须为正确的URL.',
        ];
    }
}
