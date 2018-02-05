<?php

namespace App\Http\Requests\CPanel\General;

use Illuminate\Foundation\Http\FormRequest;

class TitleRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:titles'
        ];
    }
    
    public function messages()
    {
    	return [
    		'name.required' => 'Title Names is required',
    		'name.unique' => 'Title Names has to be unique',
	    ];
    }
}
