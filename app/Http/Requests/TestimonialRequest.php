<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Route;

class TestimonialRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $routeName= ROUTE::currentRouteName();
         if ($routeName == 'testimonial.edit')
          {
            $image = 'image|mimes:jpeg,png,jpg,gif,svg|max:1000';
        }
        else
        {
            $image = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000';
        }
         
        return 
        [
            'name'=>'required',
            'description'=>'required',
            'status'=>'required',
            'position'=>'required',
            'image'=>$image
        ];
    }
}
