<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Route;

class PermissionsRequest extends FormRequest
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
        if ($routeName == 'permission.edit')
          {
           $name = 'required|unique:permissions,name,' . $this->id;
          }
          else
          {
              $name = 'required|unique:permissions,name';
          }
        return [
            'name'              =>$name,
            'default'           =>'required'
        ];
    }
}
