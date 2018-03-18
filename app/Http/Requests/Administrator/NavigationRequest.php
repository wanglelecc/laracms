<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class NavigationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:1|max:100',
            'category' => 'required|'.Rule::in(['desktop','footer','mobile',]),
            'type' => 'required|'.Rule::in(['action','link','article','page','category']),
            'target' => 'required|'.Rule::in(['_self','_blank',]),
            'description' => 'nullable|max:255',
            'parent' => 'required|integer',
            'order' => 'nullable|integer',
            'path' => 'nullable|alpha_dash|max:255',
            'link' => 'nullable|url|max:255',
            'icon' => 'nullable|alpha_dash|max:255',
//            'params' => 'nullable|alpha_dash|max:255',
        ];
    }

}
