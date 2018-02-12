<?php

namespace App\Http\Requests\CPanel\General;

use Illuminate\Foundation\Http\FormRequest;

class AddressTypeRequest extends FormRequest
{
	
	public function authorize()
	{
		return true;
	}
	
	public function rules()
	{
		return [
			'name' => 'required|unique:address_types'
		];
	}
	
	public function messages()
	{
		return [
			'name.required' => 'Address Type Name is required',
			'name.unique' => 'Address Type Name has to be unique',
		];
	}
}
