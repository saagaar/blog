<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
class AdminController extends Controller
{
    public function login(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->input();
            if(Auth::attempt(['username'=>$data['username'],'password'=>$data['password'],'user_type'=>'1'])){
                return redirect('/dashboard');
            }else{
                return redirect('/admin/login')->with('flash_message_error','Invalid username or password');
            }
        }
        
        return view('admin.admin_login');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function logout(){
        Session::flush();
        return redirect('/admin/login')->with('flash_message_success','Logged out successfully');
    }
}
