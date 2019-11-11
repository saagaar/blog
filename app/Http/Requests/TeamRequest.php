<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Route;
class TeamRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
         $routeName= ROUTE::currentRouteName();
        if ($routeName == 'team.edit')
          {
            // Update operation, exclude the record with id from the validation:
            $image = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
          }
          else
          {
            $image = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
          }
        return 
        [
            'name'=>'required',
            'position'=>'required',
            'description'=>'required',
            'image'=>$image,
            'status'=>'required',
            'linkedin_url'=>'required',
            'facebook_url'=>'required',
            'twitter_url'=>'required',
            'github_url'=>'required',
            
        ];
    }
}
