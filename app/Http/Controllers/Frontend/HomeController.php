<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;



class HomeController extends BaseController
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
  
    public function dashboard()
    {
       // $user = Socialite::driver('facebook')->user();
      
        return view('frontend.layouts.dashboard');

    }
}
