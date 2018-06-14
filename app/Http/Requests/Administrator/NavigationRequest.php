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
use Illuminate\Routing\Router;

class NavigationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|min:1|max:100',
            'category' => 'required|'.Rule::in(['desktop','footer','mobile',]),
            'type' => 'required|'.Rule::in(['action','link','article','page','category','navigation']),
            'target' => 'required|'.Rule::in(['_self','_blank',]),
            'description' => 'nullable|max:255',
            'parent' => 'required|integer',
            'order' => 'nullable|integer',
            'path' => 'nullable|alpha_dash|max:255',
            'link' => 'nullable|url|max:255',
            'icon' => 'nullable|alpha_dash|max:255',
//            'params' => 'nullable|alpha_dash|max:255',
        ];

        if($this->type == 'action'){
            $rules = array_merge($rules,[
                'params.route' => 'required',
                'params.params' => 'required',
            ]);
        }else if($this->type == 'link'){
            $rules = array_merge($rules,[
                'params.link' => 'required|url|max:255',
            ]);
        }else if($this->type == 'article'){
            $rules = array_merge($rules,[
                'params.category_id' => 'required|integer',
            ]);
        }else if($this->type == 'page'){
            $rules = array_merge($rules,[
                'params.page_id' => 'required|integer',
            ]);
        }else if($this->type == 'category'){
            $rules = array_merge($rules,[
                'params.category_id' => 'required|integer',
            ]);
        }

        return $rules;
    }

    public function messages(){
        return [
            'params.route.required' => '路由不能为空',
            'params.params.required' => '路由参数不能为空',
            'params.link.required' => '链接不能为空',
            'params.category_id.required' => '文章分类不能为空',
            'params.page_id.required' => '页面不能为空',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if($this->type == 'action'){
                if (!$this->checkRoute()) {
                    $validator->errors()->add('params.route', '路由错误');
                }
            }
        });
    }

    /**
     * 检查路由
     * @return bool
     */
    public function checkRoute(){
        $router = app(Router::class);
        $params = $this->params;
        return $router->getRoutes()->getByName($params['route']) ? true : false;
    }

}
