<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return[ 

            'title'=>'required',
            'content'=>'required',
            'display_order'=>'required',
            'status'=>'required',
        ];
    }
}
