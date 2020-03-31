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
            'contact_email'                 =>'required|min:2|max:50|email',
            'noreply_email'                 =>'required|min:2|max:50|email',
            'contact_name'                  =>'required|min:2|max:50',
            'contact_number'                =>'required|min:2|max:50',
            'mode'                          =>'required',
            'maintainence'                  =>'',
            'user_requires_activation'      =>'required',
            'blog_requires_activation'      =>'required',
            'facebook_id'                   =>'max:50',
            'linkedin_id'                   =>'max:50',
            'twitter_id'                    =>'max:50',
            'instagram_id'                  =>'max:50',
            'youtube'                       =>'max:50',
            'timezone'                      =>'required',
            'currency_sign'                 =>'required',
            'currency_code'                 =>'required',
            'address'                       =>'required|min:2|max:50',
            'city'                          =>'required|min:2|max:50',
            'state'                         =>'',
            'country'                       =>'required',
            'url'                           =>'required',
            'message'                       =>'',
            'duration'                      =>'integer|between:0,30' 
            
        ];
    }


}
