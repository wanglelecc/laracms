<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/09/25 13:27:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */
use Illuminate\Validation\Rule;

return [
    'structure' => [
        
        'feedback' => [
            'form'          => 'feedback',
            'name'          => 'feedback',
            'title'         => '意见反馈',
            'template'      => '',
            'verification'  => true,
            
            'redirect'      => [ 'route' => 'index', 'message' => '提交成功', ],
            
            'creating'      => function($requests){ return true; },
            'created'       => function($requests, $form){},
            
            'field'         => [
                
                'title' => [
                    'name'          => '标题',
                    'type'          => 'text',
                    'required'      => true,
                    'listShow'      => true,
                    'width'         => '',
                    'attributes'    => ['class' => '', 'min' => 1, 'max' => 128, ],
                    'rules'         => [
                       'title'      => ['required', 'min:1', 'max:128', ]
                    ],
                    'messages'      => [],
                ],
                
                'description' => [
                    'name'          => '描述',
                    'type'          => 'textarea',
                    'required'      => true,
                    'listShow'      => true,
                    'width'         => '',
                    'attributes'    => ['class' => '', 'id' => '', 'maxLength' => '', ],
                    'rules'         => [
                      'description' => ['required', 'min:1', 'max:128',]
                    ],
                    'messages'      => [],
                ],
    
                'sex' => [
                    'name'          => '性别',
                    'type'          => 'radio',
                    'required'      => true,
                    'listShow'      => true,
                    'width'         => '50',
                    'class'         => 'text-center',
                    'attributes'    => ['class' => '', 'id' => '', 'maxLength' => '', ],
                    'default'       => 'female',
                    'options'       => $sexOptions = [ 'male' => '男', 'female' => '女', ],
                    'rules'         => [
                        'sex'       => ['required', Rule::in(array_keys($sexOptions))],
                    ],
                    'messages'      => [],
                ],
                
                'hobby' => [
                    'name'          => '兴趣爱好',
                    'type'          => 'checkbox',
                    'required'      => true,
                    'listShow'      => true,
                    'width'         => '',
                    'attributes'    => ['class' => '', 'id' => '', 'maxLength' => '', ],
                    'default'       => [ 'calligraphy' ],
                    'options'       => $hobbyOptions = [ 'calligraphy' => '书法', 'swim' => '游泳', 'mountaineer' => '爬山', 'music' => '音乐', ],
                    'rules'         => [
                        'hobby'     => ['required', 'array', 'min:1', 'max:4', ],
                        'hobby.*'   => [ Rule::in(array_keys($hobbyOptions)) ],
                    ],
                    'messages'      => [],
                ],
                
            ],
            
            
        ],
        
    ],
];