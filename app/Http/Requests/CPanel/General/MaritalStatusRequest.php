<?php

namespace App\Http\Requests\CPanel\General;

use Illuminate\Foundation\Http\FormRequest;

class MaritalStatusRequest extends FormRequest
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
            'name' => 'required|unique:marital_statuses'
        ];
    }
	
	public function messages()
	{
		return [
			'name.required' => 'Name is required',
			'name.unique' => 'Name has to be unique',
		];
	}
	
}
