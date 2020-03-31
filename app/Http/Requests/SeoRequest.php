<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoRequest extends FormRequest
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
       
            $image = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            return [
                'pageid'                        =>'',
                'page_slug'                     =>'required|unique:seos,page_slug,'.request()->id,
                'meta_title'                     =>'required|max:90',
                'meta_key'                      =>'min:5|max:250',
                'meta_description'              =>'required|min:5|max:180',
                'schema1'                       =>'min:1',
                'schema2'                       =>'min:1',
                'image'                         =>$image
            ];
    }
}
