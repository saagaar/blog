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
        return [
            'pageid'                        =>'required',
            'page_slug'                     =>'required',
            'meta_title'                     =>'required',
            'meta_key'                      =>'required|min:5',
            'meta_description'              =>'required|min:5',
            'schema1'                       =>'required|min:5',
            'schema2'                       =>'required|min:5'
        ];
    }
}
