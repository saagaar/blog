<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsRequest extends FormRequest
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
            'heading' => 'required|min:5|max:100',
            'content'=>'required',
            'cms_slug'=>'required|min:1|max:50',
            'page_title'=>'required|min:5|max:200',
            'meta_key'=>'max:80',
            'meta_description'=>'max:150',
            'status'=>'required',
            'cms_type'=>'required|min:2|max:20',
            'deletable'=>'required'
        ];
    }
}
