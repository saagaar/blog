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
        return view('frontend.layouts.app');
    }
    public function test(VisitorInfo $info)
    {
        $dataa = $info->visitorsIp();
        $logdata = $this->websitelog->getall()->where('ip_address','27.34.25.94')->first();
        $start = date_create($logdata->visit_date);
        $end = date_create(date("Y-m-d H:i:s"));
        $diff=date_diff($end,$start);
        if($logdata->ip_address==$dataa['ip_address']){
       if((($logdata->referer_url!=$dataa['refererurl']) || ($logdata->redirected_to!=$dataa['path']) ) || ($logdata->ip_address==$dataa['ip_address']) && ($logdata->referer_url==$dataa['refererurl']) && ($logdata->redirected_to==$dataa['path']) && ($diff->i>10)){
                // $logdata->logdetailscreate();
            }
        }

        return view('frontend.home.index');
    }
    // public function test(VisitorInfo $info)
    // {
    //     // $this->savelog($info);

    //     return view('frontend.home.test');
    // }
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

    function get_server_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
