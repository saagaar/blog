<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
       if ($this->method() == 'POST')
          {
            // Update operation, exclude the record with id from the validation:
            $email_rule = 'required|email|unique:users,email,' . $this->id;
            $password              = 'required|min:6';
            $password_confirmation = 'required|min:6|same:password';
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
