<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class AccountRequest extends FormRequest
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
       if ($this->method() == 'POST')
          {
            if ($request->password) {
                $password              = 'min:6';
                $password_confirmation = 'min:6|same:password';
            }else{
                $password              = '';
                $password_confirmation = '';
            }
            // Update operation, exclude the record with id from the validation:
            $email_rule            = 'required|email|unique:users,email,' . $this->id;
            
          }
          else
          {
            $email_rule            = 'required|email|unique:users,email';
            $password              = 'required|min:6';
            $password_confirmation = 'required|min:6|same:password';

          }
        return [
            'name'                  =>'required|min:6',
            'email'                 => $email_rule,
            'status'                =>'required',
            'password'              => $password,
            'password_confirmation' => $password_confirmation,
        ];
    }
}
