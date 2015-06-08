<?php namespace Omashu\Http\Requests;

use Omashu\Http\Requests\Request;

class ResetPasswordRequest extends Request
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
            'current_password' => 'required|min:8',
            'new_password'     => 'required|min:8'
        ];
    }

}
