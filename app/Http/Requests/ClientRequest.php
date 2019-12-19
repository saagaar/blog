<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Route;

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $routeName= ROUTE::currentRouteName();
        if ($routeName == 'client.edit')
          {
            
            $image = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
          }
          else
          {
            $image = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
          }
        return[ 

            'title'=>'required',
            'url'=>'required',
            'status'=>'required',
            'logo'=>$image
        ];
    }
}
