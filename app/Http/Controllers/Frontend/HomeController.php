<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Blogs;
use App\Services\VisitorInfo;
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

        header("HTTP/1.1 200");
                                        header("RECEIVEOK");
                                        echo "RECEIVEOK";exit;
        return view('frontend.layouts.app');
    }

    public function test(Request $request,VisitorInfo $info)
    {
        $data = $request->session()->all();
        // print_r($data);exit;
        $this->savelog($info);

        return view('frontend.home.test');
    }
    public function dashboard()
    {
        if(\Auth::check())
        return view('frontend.layouts.dashboard');
        else
             return redirect()->route('home'); 
    }

}
