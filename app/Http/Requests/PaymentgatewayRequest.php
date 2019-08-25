<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentgatewayRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
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
        return[ 

            'email'=>'required|email|max:255|regex:/(.*)@gmail\.com/i|unique:users',
            'mode'=>'required',
            'image'=>$image,
            'api_merchant_key'=>'required',
            'api_merchant_password'=>'required',
            'api_merchant_signature'=>'required',
            'api_version'=>'required',
            'status'=>'required',
            'payment_gateway'=>'required'
        ];
    }
}
