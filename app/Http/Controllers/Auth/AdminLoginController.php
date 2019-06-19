<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    	// $this->middleware('guest:admin');
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard/';

    /**
     * Calling view for admin login
     *
     * @return void
     */
	
  	public function ShowLoginForm()
  	{
  		return view('admin.admin_login');
  	}

  	public function login(Request $request)
    {

        $this->validate($request,[
        		'email'	=>	'required|email',
        		'password'=>'required|min:6'
        	]);


        // // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // // the login attempts for this application. We'll key this by the username and
        // // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->	attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    public function dashboard()
    {
    	dd('We are successfull');
    }
    // public function logout(){
    // 	dd('loggedout');
    // }
}
