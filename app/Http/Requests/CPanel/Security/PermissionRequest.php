<?php

namespace App\Http\Requests\CPanel\Security;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
	
	public function rules()
	{
		return [
			'name' => 'required|unique:permissions',
			'display_name' => 'required'
		];
	}
	
	public function messages()
	{
		return [
			'name.required' => 'Permission Name is required',
			'name.unique' => 'Permission Name has to be unique',
			'display_name.required' => 'Permission Display Name is required',
		];
	}
}
