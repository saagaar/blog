<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminuserRequest extends FormRequest
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
            // dd(request()->password);
            if (request()->password) {
                $password              = 'min:6';
                $password_confirmation = 'min:6|same:password';
            }else{
                $password              = '';
                $password_confirmation = '';
            }
            // Update operation, exclude the record with id from the validation:
            $email_rule = 'required|email|unique:admin_users,email,' . $this->id;
            $username = 'required|unique:admin_users,username,'. $this->id;
          }
          else
          {
            $username = 'required|unique:admin_users,username';
            $email_rule = 'required|email|unique:admin_users,email';
          }
        return [
            'username'              => $username,
            'email'                 => $email_rule,
            'role_id'               =>'required',
            'status'                =>'required',
            'password'              => $password,
            'password_confirmation' => $password_confirmation,
        ];
    }
}
