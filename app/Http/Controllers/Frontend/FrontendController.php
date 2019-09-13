<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repository\SiteoptionsInterface;
use App\Services\VisitorInfo;
use Illuminate\Support\Facades\Route;
use App\Models\Userlogs;
use App\Repository\UserlogInterface;

class FrontendController extends BaseController
{
    Protected $siteSettings;

    Protected $UserlogInterface;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $ipInfoService;
    public function __construct()
    {
        $SiteoptionsInterface = app()->make('App\Repository\SiteoptionsInterface');
        $this->UserlogInterface = app()->make('App\Repository\UserlogInterface');
        $this->siteSettings=$SiteoptionsInterface->GetSiteInfo();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // print_r($request->server('HTTP_USER_AGENT'));
        return view('frontend.home.index');
    }
  
    public function dashboard(){
       $user = Socialite::driver('facebook')->user();
      
        // return view('frontend.user.dashboard');

    }
    public function savelog(VisitorInfo $info){
        $serverdata =  $info->visitorsIp();
        // print_r($serverdata['path']);exit;
        date_default_timezone_set('Asia/Kathmandu');
        $dblogdata=$this->UserlogInterface->getLogbyIpAddressAndURL($serverdata['ip_address'],$serverdata['path']);
        // print_r($dblogdata);exit;
        if($dblogdata){
            $start = date_create($dblogdata['details']->visit_date);
        $end = date_create(date("Y-m-d H:i:s"));
        $diff=date_diff($end,$start);
        }
        if($dblogdata){
        if((($dblogdata['ip']->ip_address==$serverdata['ip_address'])  && ($dblogdata['details']->redirected_to!=$serverdata['path'])) || ( ($dblogdata['ip']->ip_address==$serverdata['ip_address'])  && ($dblogdata['details']->redirected_to==$serverdata['path']) && ($diff->i>10)) ){
            $logdata = array(
                    'referer_url'   =>$serverdata['refererurl'],
                    'user_agent'    =>$serverdata['useragent'],
                    'redirected_to' =>$serverdata['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
                $dblogdata['ip']->logdetails()->create($logdata);
            }
        }else{
            $logdata = array(
                    'referer_url'   =>$serverdata['refererurl'],
                    'user_agent'    =>$serverdata['useragent'],
                    'redirected_to' =>$serverdata['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
            $logcreate= $this->userlog->create(
                   array(
                     'ip_address'           =>$serverdata['ip_address'],
                    'country'               =>$serverdata['country'],
                    'country_code'          =>$serverdata['country_code'],
                    'region'                =>$serverdata['region'],
                    'region_code'           =>$serverdata['region_code'],
                    'city'                  =>$serverdata['city'],
                    'time_zone'             =>$serverdata['time_zone'],
                    'latitude'              =>$serverdata['latitude'],
                    'longitude'             =>$serverdata['longitude'],
                    'isp'                   =>$serverdata['organisation'],
                    'flagurl'               =>$serverdata['flagurl'],
                    'currencysymbol'        =>$serverdata['currencysymbol'],
                    'currency'              =>$serverdata['currency'],
                    'callingcode'           =>$serverdata['callingcode'],
                    'countrycapital'        =>$serverdata['countrycapital'],
                   )
                );
            $logcreate->logdetails()->create($logdata);
        }
    }
}
