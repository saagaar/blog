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
            'site_name'                     =>'required|min:6|max:50',
            'log_admin_activity'            =>'required',
            'log_admin_invalid_login'       =>'required',
            'contact_email'                 =>'required|min:6|max:50',
            'contact_name'                  =>'required|min:6|max:50',
            'contact_number'                =>'required|min:6|max:50',
            'mode'                          =>'required',
            'maintainence'                  =>'required',
            'user_requires_activation'      =>'required'
            'blog_requires_activation'      =>'required',
            'facebook_id'                   =>'required|min:6|max:50',
            'linkedin_id'                   =>'required|min:6|max:50',
            'twitter_id'                    =>'required|min:6|max:50',
            'instagram_id'                  =>'required|min:6|max:50',
            'youtube'                       =>'required|min:6|max:50',
            'timezone'                      =>'required',
            'currency_sign'                 =>'required',
            'currency_code'                 =>'required',
            'address'                       =>'required|min:6|max:50',
            'city'                          =>'required|min:6|max:50',
            'state'                         =>'required',
            'country'                       =>'required',
        ];
    }
}
