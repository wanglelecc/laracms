<?php

namespace App\Http\Requests;

class VerificationCodeRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required|regex:/^1[3456789]\d{9}$/|unique:users',
        ];
    }

    public function attributes()
    {
        return [
        ];
    }
}
