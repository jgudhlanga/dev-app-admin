<?php

namespace App\Http\Requests\CPanel\General;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
            'title' => 'required|unique:statuses',
        ];
    }
	
	public function messages()
	{
		return [
			'title.required' => 'Title Names is required',
			'title.unique' => 'Title Names has to be unique',
		];
	}
	
}
