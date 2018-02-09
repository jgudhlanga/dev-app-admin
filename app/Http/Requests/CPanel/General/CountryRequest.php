<?php

namespace App\Http\Requests\CPanel\General;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name' => 'required|unique:countries',
            'full_name' => 'required',
	        'capital' => 'required',
	        'country_code' => 'required|max:3',
	        'calling_code' => 'required|max:3',
	        'currency_symbol' => 'required|max:3',
	        'iso_3166_2' => 'required|max:2',
	        'iso_3166_3' => 'required|max:3'
        ];
    }
}
