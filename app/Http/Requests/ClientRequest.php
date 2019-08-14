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
            'url'=>'required',
            'logo'=>$image,
            'status'=>'required',
        ];
    }
}
