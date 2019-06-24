<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminRoles;
use App\Models\LogAdminActivitys;
class AdminRoleController extends Controller
{
    public function create()
    {
        $adminrole = AdminRoles::find(1);	
        $log = new LogAdminActivitys;
        $log->log_time = "2019-6-24";
        $log->log_action = "add";
        $log->log_ip = "01";
        $log->log_browser= "opera";
        $log->log_platform="windows";
        $log->log_agent = "oss";
        $log->log_referer = "http://127.0.0.1:8000/adminrole";
        $adminrole->logs()->save($log);
    }
}
