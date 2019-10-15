<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSettings extends Model
{
    protected $guarded='notification_settings';

    /**
     * The attributes that have specific data types are declared
     *
     * @var array
     */
    protected $casts = [
            'notification_type' => 'array'
        ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','code','subject','view','email_body','database_body','sms_body','notification_type','active'
    ];
    
}
