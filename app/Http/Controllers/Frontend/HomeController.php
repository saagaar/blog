<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Blogs;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Userlogs;
use App\Repository\UserlogInterface;
class HomeController extends FrontendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    function __construct()
    {

         parent::__construct();
    }

    /**
     * Show the application dashboard.
     *p
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // print_r($this->siteName);
        return view('frontend.layouts.app');
    }

    public function test(Request $request)
    {
        return view('frontend.layouts.app');
    }
    public function dashboard()
    {
        if(\Auth::check())
        return view('frontend.layouts.dashboard');
        else
             return redirect()->route('home'); 
    }

}
