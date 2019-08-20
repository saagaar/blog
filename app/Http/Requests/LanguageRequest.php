<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return 
        [
            'short_code'=>'required|max:2',
            'lang_name'=>'required',
            'status'=>'required',
            'currency_code'=>'required',
            'currency_sign'=>'required',
            'priority'=>'required',
        ];
    }
}
