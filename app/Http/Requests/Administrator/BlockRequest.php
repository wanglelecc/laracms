<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class BlockRequest extends Request
{
    public function rules()
    {

        return [
//            'type' => 'required|'.Rule::in(['latestArticle','hotArticle','latestProduct','hotProduct','slide','articleTree','productTree','blogTree','pageList','contact','about','links','header','followUs','html','htmlcode','phpcode']),
            'type' => 'required|'.Rule::in(array_keys(config('blocks.types'))),
//            'group' => 'required|integer',
            'title' => 'required|min:1|max:255',
            'more_title' => 'nullable|max:255',
            'more_link' => 'nullable|url',
        ];

        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    // CREATE ROLES
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // UPDATE ROLES
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
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
