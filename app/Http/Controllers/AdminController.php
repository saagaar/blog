<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserInterface;
use App\Services\NotificationCommander;
use Auth;
use Session;
class AdminController extends Controller
{
    
    protected $user;

    function __construct(UserInterface $admin)
    {
        $this->admin=$admin;
        $this->middleware('auth:admin')->except('logout');
    }
    public function dashboard()
    {

        
        // $data=($this->user->getAll());
        // dd($data->username);
        return view('admin.dashboard');
    }
    
    
    public function checkmail(){
        $notify=new NotificationCommander();
        $notifytype=$notify::build('email');
       $notifytype->setup();
        // new \App\Services\EmailNotification();
    }
}
