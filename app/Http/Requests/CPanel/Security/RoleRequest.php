<?php

namespace App\Http\Requests\CPanel\Security;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
	        'name' => 'required|unique:roles',
	        'display_name' => 'required'
        ];
    }
	
	public function messages()
	{
		return [
			'name.required' => 'Role Name is required',
			'name.unique' => 'Role Name has to be unique',
			'display_name.required' => 'Role Display Name is required',
		];
	}
}
