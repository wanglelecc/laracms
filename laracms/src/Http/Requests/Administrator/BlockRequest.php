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
    
    public function attributes()
    {
        return [
            'type' => '类型',
            'title' => '名称',
            'more_title' => '更多链接标题',
            'more_link' => '更多链接地址',
        ];
    }
}
