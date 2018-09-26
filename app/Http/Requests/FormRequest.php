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

namespace App\Http\Requests;
use Illuminate\Validation\Rule;


class FormRequest extends Request
{
    public function rules()
    {
        return array_merge([
            'type' => [ 'required', Rule::in(array_keys(config('form.structure')))],
        ], $this->getFormRules($this->type));
    }
    
    public function messages()
    {
        return array_merge([
            'type.error' => '错误的表单.',
        ], $this->getFormMessages($this->type));
    }
    
    /**
     * @param $type
     *
     * @return array
     */
    protected function getFormRules($type){
        $fields = config('form.structure.' . strtolower($type) . '.field');
        if(!$fields){ abort(404); }
        
        $rules = [];
    
        if(config('form.structure.' . strtolower($type) . '.verification')){
            $rules['captcha'] = ['required','captcha'];
        }
        
        foreach($fields as $field){
            if($field['rules']){
                $rules = array_merge($rules, $field['rules']);
            }
        }
        
        return $rules;
    }
    
    /**
     * @param $type
     *
     * @return array
     */
    protected function getFormMessages($type){
        $fields = config('form.structure.' . strtolower($type) . '.field');
        if(!$fields){ abort(404); }

        $messages = [
            'captcha.captcha' => '验证码错误',
        ];
        
        foreach($fields as $field){
            if($field['messages']){
                $messages = array_merge($messages, $field['rules']);
            }
        }

        return $messages;
    }
    
    /**
     * 检查提交频率，排除非人工提交
     *
     * @param $validator
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if($this->method() == 'POST'){
                if ($this->checkSubmitFrequency()) {
                    $validator->errors()->add('type', '提交频率太快，请待会再来提交.');
                }
                
                // 执行表单前置回调, 只要返回非 true ，均为禁止保存，并抛出错误信息
                if( ($message = call_user_func(config('form.structure.'.strtolower($this->type).'.creating'), $this)) !== true ){
                    $validator->errors()->add('type', $message);
                }
            }

        });
    }
    
    /**
     * 检查同一个IP，在一定时间段内提交过多
     */
    public function checkSubmitFrequency()
    {
        $ip = $this->ip();
        
        return false;
    }
    
    /**
     * 获取表单数据
     *
     * @return array
     */
    public function getFormData(){
        $fields = config('form.structure.' . strtolower($this->type) . '.field');
        if(!$fields){ abort(404); }
    
        $data = [];
        foreach($fields as $key => $field){
            $data[$key] = $this->$key ?? null;
        }
    
        return $data;
    }
    
}