<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        if ($this->method() == 'POST')
          {
            // Update operation, exclude the record with id from the validation:
            $image = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
          }
          else
          {
            $image = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
          }
        return [
                'title'      => 'required|min:5|max:255',
                'content'    =>'required|min:5',
                'locale_id'  => 'required',
                'save_method'=> 'required',
                'image' => $image,
                'tags'          =>'required'
        ];
    }
}
