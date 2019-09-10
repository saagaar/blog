<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Services\VisitorInfo;
use Illuminate\Support\Facades\Route;
use App\Models\Logdetails;
use App\Repository\UserlogInterface;
class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   protected $websitelog;
    function __construct(UserlogInterface $websitelog)
    {
         $this->websitelog=$websitelog;
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
    public function test(VisitorInfo $info)
    {
        $serverdata = $info->visitorsIp();
        $dblogdata = $this->websitelog->getall()->where('ip_address','27.34.25.94')->first();
        $start = date_create($dblogdata->visit_date);
        $end = date_create(date("Y-m-d H:i:s"));
        $diff=date_diff($end,$start);
        if($dblogdata->ip_address==$serverdata['ip_address']){
        if((($dblogdata->referer_url!=$serverdata['refererurl']) || ($dblogdata->redirected_to!=$serverdata['path']) ) || ($dblogdata->ip_address==$serverdata['ip_address']) && ($dblogdata->referer_url==$serverdata['refererurl']) && ($dblogdata->redirected_to==$serverdata['path']) && ($diff->i>10)){
                $dblogdata->logdetails->create(array(
                    'referer_url'   =>$serverdata['refererurl'],
                    'user_agent'    =>$serverdata['useragent'],
                    'redirected_to' =>$serverdata['refererurl'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                ));
            }
        }
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
