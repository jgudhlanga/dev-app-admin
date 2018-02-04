<?php

namespace App\Http\Requests\Cpanel\General;

use Illuminate\Foundation\Http\FormRequest;

class GenderRequest extends FormRequest
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
	
	public function rules()
	{
		return [
			'name' => 'required|unique:genders'
		];
	}
	
	public function messages()
	{
		return [
			'name.required' => 'Gender Name is required',
			'name.unique' => 'Gender Name has to be unique',
		];
	}
}
