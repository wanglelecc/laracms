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

class SlideRequest extends Request
{
    public function rules()
    {
        return [
            'group' => 'required|integer',
            'title' => 'required|min:1|max:255',
            'image' => 'required|max:255',
            'link' => 'required|url',
            'description' => 'nullable|max:255',
            'target' => 'required|min:1,max:255',
            'order' => 'nullable|integer',
            'status' => 'nullable|integer',
        ];
    }
    
    public function attributes(){
        return [
            'image' => '图片',
        ];
    }
}
