<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
            'title'=>'required',
            'code'=>'required|unique:notification_settings,code,'. $this->id,
            'subject'=>'required',
            'view'=>'required',
            'email_body'=>'required',
            'database_body'=>'required',
            'sms_body'=>'',
            'notification_type'=>'required',
            'active'=>'required'
        ];
    }
}
