<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class WechatResponseRequest extends Request
{
    public function rules()
    {
        return [
            // CREATE ROLES
            'wechat_id' => 'required|integer',
            'type' => 'required|'.Rule::in(['text','link','news']),
            'key' => 'required|min:1|max:128',
            'group' => 'required|string|min:1|max:128',
            'content' => 'required|array',
        ];

        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
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
            // Validation messages
        ];
    }
}
