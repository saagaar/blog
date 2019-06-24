<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAdminActivitys extends Model
{
    protected $guard='log_admin_activitys';

    protected $fillable = [
        'log_time','log_userid'
    ];

}
