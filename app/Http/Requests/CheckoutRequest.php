<?php

namespace Omashu\Http\Requests;

use Omashu\Http\Requests\Request;

class CheckoutRequest extends Request
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
            'name' => 'required|max:255',
            'email' => 'required|email|confirmed',
            'phone' => 'max:255',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '請填寫您的大名',
            'address.required' => '請填寫您的地址',
            'email.required' => '請填寫您的電子信箱',
            'email.confirmed' => '電子信箱請再次確認無誤'
        ];
    }
}
