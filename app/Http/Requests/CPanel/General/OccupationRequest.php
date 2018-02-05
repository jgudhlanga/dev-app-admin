<?php

namespace App\Http\Requests\CPanel\General;

use Illuminate\Foundation\Http\FormRequest;

class OccupationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
	
	public function rules()
	{
		return [
			'name' => 'required|unique:occupations'
		];
	}
	
	public function messages()
	{
		return [
			'name.required' => 'Occupation Name is required',
			'name.unique' => 'Occupation Name has to be unique',
		];
	}
}
