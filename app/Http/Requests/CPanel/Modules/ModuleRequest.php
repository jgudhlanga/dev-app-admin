<?php

namespace App\Http\Requests\CPanel\Modules;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
			'title' => 'required|unique:modules',
			'module_url' => 'required|unique:modules'
		];
	}
	
	/**
	 * @return array
	 */
	public function messages()
	{
		return [
			'title.required' => 'Module title is required',
			'title.unique' => 'Module title has to be unique on the system',
			'module_url.required' => 'Module url is required',
			'module_url.unique' => 'Module url has to be unique on the system',
		];
	}
}
