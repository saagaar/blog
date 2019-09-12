<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Blogs;
use App\Services\VisitorInfo;
use Illuminate\Support\Facades\Route;
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
        return view('frontend.home.index');
    }
    public function test(VisitorInfo $info)
    {
        // $this->savelog($info);
        print_r($this->globals);exit;
        return view('frontend.home.test');
    }
    public function blog()
    {
        $blog = Blogs::all()->latest();
        return response($blog->jsonSerialize(), Response::HTTP_OK);
    }
    public function dashboard()
    {
       // $user = Socialite::driver('facebook')->user();
      
        return view('frontend.layouts.dashboard');

    }

}
