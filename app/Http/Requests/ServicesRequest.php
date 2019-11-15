<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Route;

class ServicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $routeName= ROUTE::currentRouteName();
        if ($routeName == 'services.edit')
          {
            $image = 'image|mimes:jpeg,png,jpg,gif,svg|max:1000';
          }
          else
          {
            $image = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000';
          }
        return 
        [
            'title'=>'required',
            'description'=>'required',            
            'status'=>'required',  
            'icon'=>$image          
        ];
    }
}
