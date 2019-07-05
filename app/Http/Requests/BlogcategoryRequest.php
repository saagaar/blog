<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogcategoryRequest extends FormRequest
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
            $slug = 'required|min:5|max:255|unique:blog_categories,slug,'. $this->id;
          }
          else
          {
            $slug = 'required|min:5|max:255|unique:blog_categories,slug';
          }
        return [
                'name'      => 'required|min:5|max:255',
                'display'   => 'required',
                'slug'      => $slug
        ];
    }
}
