<?php

namespace App\Http\Requests\CPanel\Modules;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
			'title' => 'required',
			'module_id' => 'required',
			'page_url' => 'required'
		];
	}
	
	/**
	 * @return array
	 */
	public function messages()
	{
		return [
			'title.required' => 'Page title is required',
			'module_id.required' => 'Page Module is required',
			'page_url.required' => 'Page url is required',
		];
	}
}
