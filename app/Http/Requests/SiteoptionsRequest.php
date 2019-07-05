<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteoptionsRequest extends FormRequest
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
            'site_name'                  =>'required',
            'log_admin_activity'         =>'required',
            'log_admin_invalid_login'    =>'required',
            'contact_email'              =>'required',
            'contact_name'               =>'required',
            'contact_number'             =>'required',
            'mode'                       =>'required',
            'maintainence'               =>'required',
            'user_activation'            =>'required',
            'facebook_id'                =>'required',
            'linkedin_id'                =>'required',
            'twitter_id'                 =>'required',
            'instagram_id'               =>'required',
            'youtube'                    =>'required',
            'timezone'                   =>'required',
            'currency_sign'              =>'required',
            'currency_code'              =>'required',
            'address'                    =>'required',
            'city'                       =>'required',
            'state'                      =>'required',
            'country'                    =>'required',
        ];
    }
}
