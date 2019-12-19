<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAdminActivities extends Model
{
    protected $guard='log_admin_activities';

    protected $fillable = [
        'log_time','logable_id','logable_type','log_action','log_ip','log_browser','log_platform','log_agent','log_referer','log_extra_info'
    ];
    public function logables()
    {
        return $this->morphTo();
    }
}
