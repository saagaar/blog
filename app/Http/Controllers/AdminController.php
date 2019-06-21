<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
class AdminController extends Controller
{
     function __construct()
    {
      $this->middleware('auth:admin')->except('logout');
    }

    public function dashboard(){
      
        return view('admin.dashboard');
    }
    public function logout(){
      Session::flush();
      return redirect('/admin/login')->with('flash_message_success','Logged out successfully');
  }
}
