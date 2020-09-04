<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\UserInterface;
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
    protected $admin;
    function __construct(UserInterface $admin)
    {
      $this->middleware('guest:admin');
      $this->admin = $admin;
    }

    // use AuthenticatesUsers;

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
         $data = $this->admin->getByEmail($request->email); 
     //Attempt for user login
    if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>'1'],$request->remember))
    {
      $data->where('email',$request->email)->update(array('invalid_login'=>'0'));
    	return redirect()->intended(route('admin.dashboard'));
	  }
    if($data->status=='1'){
      if($data->invalid_login<4){
            $count = $data->invalid_login;
            $count = $count + 1;
             $data->where('email',$request->email)->update(array('invalid_login'=>$count));
          }else{
            $data->where('email',$request->email)->update(array('status'=>'0'));
            return redirect()->back()->withInput($request->only('email','remember'))->with('flash_message_error','Your account has been disabled');
          }
        return redirect()->back()->withInput($request->only('email','remember'))->with('flash_message_error','Invalid username or password');
      }else{
        return redirect()->back()->withInput($request->only('email','remember'))->with('flash_message_error','Your account has been disabled');
      }    
    }
    protected function guard()
    {
        return Auth::guard('auth:admin');
    }
 
}
