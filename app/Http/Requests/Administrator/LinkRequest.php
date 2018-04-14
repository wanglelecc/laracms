<?php

namespace App\Http\Requests\Administrator;
use Illuminate\Validation\Rule;

class LinkRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required|max:32',
            'url' => 'required|url|max:191',
            'target' => 'required|'.Rule::in(['_blank','_self']),
            'rating' => 'nullable|integer|max:255',
            'order' => 'nullable|integer',
            'rel' => 'nullable|max:255',
            'description' => 'nullable|max:191',
            'status' => 'nullable|'.Rule::in(['0','1']),
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

        ];
    }
}
