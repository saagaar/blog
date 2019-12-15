<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class CategoryRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $routeName= ROUTE::currentRouteName();
        if ($routeName == 'adminblogcategory.edit')
          {
            $banner = 'image|mimes:jpeg,png,jpg,gif,svg|max:1000';
           
            $slug = 'required|min:2|max:255|unique:categories,slug,'. $this->id;
            if($request->parent_id==''){
                $tags='';
            }
            else{
                $tags='required';
            }
          }
          
          else
          {
            
            $slug = 'required|min:2|max:255|unique:categories,slug';
            if($request->parent_id==''){
                $tags='';
                $banner = 'image|mimes:jpeg,png,jpg,gif,svg|max:1000';
            }
            else{
                $tags='required';
                $banner = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000';
            }
          }
        
        return [
                'parent_id'   => '',
                'name'      => 'required|min:2|max:255',
                'status'   => 'required',
                'slug'      => $slug,
                'tags'      =>$tags,
                'banner_image' => $banner,
                'show_in_home'  =>'required',
                'priority'  =>'required',
                'description'  =>'required',
                'meta_title'                    =>'required|min:5',
                'meta_keyword'                      =>'required|min:5',
                'meta_description'              =>'required|min:5',
                'schema1'                       =>'required|min:5',
                'schema2'                       =>'required|min:5'
              
        ];
    }
}
