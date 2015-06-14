<?php namespace Omashu\Http\Requests;

use Omashu\Http\Requests\Request;

class ImageUploadRequest extends Request {

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
			'file' => 'required|mimes:jpg,jpeg,bmp,gif,png,svg'
		];
	}

}
