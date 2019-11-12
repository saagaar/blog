<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Route;

class BannerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {

        $routeName= ROUTE::currentRouteName();
        if ($routeName == 'banner.edit')
          {
           $image = 'image|mimes:jpeg,png,jpg,gif,svg|max:1000';
          }
          else
          {
              $image = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000';
          }
        return[ 

            'title'=>'required',
            'content'=>'required',
            'display_order'=>'required',
            'status'=>'required',
            'image'=>$image,
            'type'=>'required'
        ];
    }
}
