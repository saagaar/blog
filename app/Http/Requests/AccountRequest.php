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
            $phone                 = 'required|unique:users,phone,' . $this->id;
             $image                ='';
            
          }
          else
          {
            $email_rule            = 'required|email|unique:users,email';
            $phone                 = 'required|unique:users,phone';
            $password              = 'required|min:6';
            $password_confirmation = 'required|min:6|same:password';
            $image                 = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
          }
        return [
            'name'                  =>'required|min:2',
            'email'                 => $email_rule,
            'status'                =>'required',
            'password'              => $password,
            'password_confirmation' => $password_confirmation,
            'phone'                 => $phone,
            'address'               =>'',
            'country'               =>'',
            'dob'                   =>'',
            'image'                 => $image,
            'is_login'              =>'required',
            
        ];
    }
}
