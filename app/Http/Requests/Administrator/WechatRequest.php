<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class WechatRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    // CREATE ROLES
                    'type' => 'required|'.Rule::in(['subscribe','service']),
                    'name' => 'required|min:1|max:64',
                    'account' => 'required|min:1|max:30',
                    'app_id' => 'required|min:1|max:30',
                    'app_secret' => 'required|min:1|max:32',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'type' => 'required|'.Rule::in(['subscribe','service']),
                    'name' => 'required|min:1|max:64',
                    'account' => 'required|min:1|max:30',
                    'app_id' => 'required|min:1|max:30',
                    'app_secret' => 'required|min:1|max:32',
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
