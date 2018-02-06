<?php

namespace App\Http\Requests\CPanel\General;

use Illuminate\Foundation\Http\FormRequest;

class RaceRequest extends FormRequest
{
	
	public function authorize()
	{
		return true;
	}
	
	public function rules()
	{
		return [
			'name' => 'required|unique:races'
		];
	}
	
	public function messages()
	{
		return [
			'name.required' => 'Race Name is required',
			'name.unique' => 'Race Name has to be unique',
		];
	}
}
