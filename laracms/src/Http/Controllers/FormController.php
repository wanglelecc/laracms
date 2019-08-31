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

namespace Wanglelecc\Laracms\Http\Controllers;

use Illuminate\Http\Request;
use Wanglelecc\Laracms\Models\Form;
use Wanglelecc\Laracms\Http\Requests\FormRequest;

/**
 * 表单制器
 *
 * Class PageController
 * @package Wanglelecc\Laracms\Http\Controllers
 */
class FormController extends Controller
{
    
    /**
     * 显示表单
     *
     * @param int $navigation
     * @param     $type
     *
     * @return mixed
     */
    public function index( $navigation = 0, $type )
    {
        $form = config('form.structure.' . strtolower($type));
        if(!$form){ abort(404); }
        
        $template = empty($form['template']) ? '' : '-'.strtolower($form['template']);
        return frontend_view('form.show'.$template, compact('form'));
    }
    
    /**
     * 表单请求
     *
     * @param FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request){
    
        $form = Form::create([
            'form' => $request->type,
            'data' => $request->getFormData(),
        ]);
    
        // 执行表单保存回调
        call_user_func(config('form.structure.'.strtolower($request->type).'.created'), $request, $form);
        
        // 获取表单跳转信息
        $redirect = config('form.structure.'.strtolower($request->type).'.redirect');
        
        return redirect()->route($redirect['route'])->with('success', $redirect['message'] );
    }
}
