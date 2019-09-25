<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return[ 

            'title'=>'required',
            'url'=>'required',
            'status'=>'required',
        ];
    }
}
