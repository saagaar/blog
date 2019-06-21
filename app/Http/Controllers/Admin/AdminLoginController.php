<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    function __construct()
    {
      $this->middleware('guest:admin')->except('logout');
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin.login';

    /**
     * Calling view for admin login
     *
     * @return void
     */
	
  	public function ShowLoginForm()
  	{
  		return view('admin.admin-login');
  	}

  	public function login(Request $request)
    {	

        $this->validate($request,[
        		'email'	=>	'required',
        		'password'=>'required|min:6'
        	]);
          
     //Attempt for user login
    if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password ],$request->remember))
    {
    	return redirect()->intended(route('admin.dashboard'));
	}
        return redirect()->back()->withInput($request->only('email','remember'))->with('flash_message_error','Invalid username or password');;
    }
    // public function dashboard()
    // {
    // 	return view('admin.dashboard');
    // }
   
    protected function guard()
    {
        return Auth::guard('auth:admin');
    }
 
}
