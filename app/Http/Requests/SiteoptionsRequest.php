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
            'site_name'                     =>'required|min:2|max:50',
            'log_admin_activity'            =>'required',
            'log_admin_invalid_login'       =>'required',
            'contact_email'                 =>'required|email|min:1|max:50',
            'contact_name'                  =>'required|min:1|max:50',
            'contact_number'                =>'required|min:1|max:50',
            'mode'                          =>'required',
            'noreply_email'                 =>'required|email|min:1|max:50',
            'google_analytics_code'         =>'',
            'user_requires_activation'      =>'required',
            'blog_requires_activation'      =>'required',
            'facebook_url'                  =>'max:50',
            'linkedin_url'                  =>'max:50',
            'twitter_url'                   =>'max:50',
            'instagram_url'                 =>'max:50',
            'youtube_url'                   =>'max:50',
            'skype_url'                     =>'max:50',
            'fb_app_id'                     =>'',
            'fb_page_id'                    =>'',
            'timezone'                      =>'required',
            'currency_sign'                 =>'',
            'currency_code'                 =>'',
            'address'                       =>'required|min:2|max:50',
            'city'                          =>'required|min:2|max:50',
            'state'                         =>'',
            'country'                       =>'required',
            'url'                           =>'required',
            'maintainence'                  =>'',
            'message'                       =>'',
            'duration'                      =>'',
            'enable_point_system'           =>'required',
            'like_weightage'                =>'required|numeric',
            'view_weightage'                =>'required|numeric',
            
        ];
    }


}
