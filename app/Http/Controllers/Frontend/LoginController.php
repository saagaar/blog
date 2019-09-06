<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Socialite;


class LoginController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }   

    /**
     * Show the application dashboard.
     *p
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // print_r($request->server('HTTP_USER_AGENT'));
        return view('frontend.home.index');
    }
    public function socialLogin($provider)
    {
        return Socialite::driver($provider)->redirect();

    }
    public function dashboard($provider){
       $user = Socialite::driver($provider)->user();
       $this->getUserInfoFromFacebook();
       print_r($user);
        // return view('frontend.user.dashboard');
    }
    
    public function getUserInfoFromFacebook()
    {

    }   
}
