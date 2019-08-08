<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bools
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
            'heading' => 'required',
            'content'=>'required',
            'cms_slug'=>'required',
            'page_title'=>'required',
            'meta_key'=>'required',
            'meta_description'=>'required',
            'is_display'=>'required',
            'cms_type'=>'required',
            'deletable'=>'required'
        ];
    }
}
