<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

         // if ($this->method() == 'POST')
         //  {
         //    $image = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
         //  }
         //  else
         //  {
         //    $image = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
         //  }

        return 
        [
            'name'=>'required',
            'description'=>'required',
            'status'=>'required',
            'position'=>'required',
        ];
    }
}
