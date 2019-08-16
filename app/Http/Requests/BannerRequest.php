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
         if ($this->method() == 'POST')
          {
            // Update operation, exclude the record with id from the validation:
            $image = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
          }
          else
          {
            $image = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
          }
        return[ 

            'title'=>'required',
            'content'=>'required',
            'image'=>$image,
            'display_order'=>'required',
            'status'=>'required',
        ];
    }
}
