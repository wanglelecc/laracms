<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class PageRequest extends Request
{
    public function rules()
    {

        return [
            'title' => 'required|min:1|max:191',
//            'object_id' => 'required|alpha_dash|unique:article|min:1|max:191',
            'keywords' => 'nullable|max:191',
            'description' => 'nullable|max:191',
            'author' => 'nullable|max:191',
            'source' => 'nullable|max:191',
            'category_id' => 'nullable|integer',
            'content' => 'required|min:1|max:65535',
            'thumb' => 'nullable|max:191',
            'order' => 'nullable|integer',
            'status' => 'nullable|integer',
            'views' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'top' => 'nullable|'.Rule::in(['0','1']),
//            'type' => 'required|alpha|min:1|max:16',
            'link' => 'nullable|alpha_dash|unique:article|max:191',
            'template' => 'nullable|alpha_dash|max:191',
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
            // Validation messages
        ];
    }
}
