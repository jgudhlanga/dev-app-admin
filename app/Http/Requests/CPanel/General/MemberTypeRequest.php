<?php

namespace App\Http\Requests\CPanel\General;

use Illuminate\Foundation\Http\FormRequest;

class MemberTypeRequest extends FormRequest
{
	
	public function authorize()
	{
		return true;
	}
	
	public function rules()
	{
		return [
			'name' => 'required|unique:member_types'
		];
	}
	
	public function messages()
	{
		return [
			'name.required' => 'Member Type Name is required',
			'name.unique' => 'Member Type Name has to be unique',
		];
	}
}
