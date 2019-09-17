<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repository\SiteoptionsInterface;
use Illuminate\Support\Facades\Route;
use App\Models\Userlogs;
use App\Jobs\VisitorLog;
use App\Repository\UserlogInterface;

class FrontendController extends BaseController
{
    Protected $siteSettings;

    Protected $UserlogInterface;

    /***
    * Wheather website is in maintainence ,live or Offline mode
    * mode enum('1'=>'live','2'=>down,'3'=>Maintainence)
    */
    Protected $websiteMode;
    /***
    * if website is in maintainence developer can access the website using maintainence key
    * @type=string
    */
    Protected $maintainenceKey;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    Protected $ipInfoService;

    public function __construct()
    {
        $SiteoptionsInterface = app()->make('App\Repository\SiteoptionsInterface');
        $this->UserlogInterface = app()->make('App\Repository\UserlogInterface');
        $this->siteSettings=$SiteoptionsInterface->GetSiteInfo();
        $this->websiteMode=$this->siteSettings->mode;
       
        if($this->websiteMode=='3')
        {
            exit('sorry we are maintaining..It is a regular maintainence');
        }
        if($this->websiteMode=='2'){
            exit('sorry we currently offline');
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('frontend.home.index');
    }
  
    public function dashboard(){
       $user = Socialite::driver('facebook')->user();
      
        // return view('frontend.user.dashboard');

    }


    public function save_visitor_info()
    {

         VisitorLog::dispatch($this->UserlogInterface,$ipaddress);

       if($dblogdata['ip'] && (trim($dblogdata['details'])!='')){

            $start = date_create($dblogdata['details']->visit_date);
        $end = date_create(date("Y-m-d H:i:s"));
        $diff=date_diff($end,$start);
        if((($dblogdata['ip']->ip_address==$serverdata['ip_address'])  && ($dblogdata['details']->redirected_to!=$serverdata['path'])) || ( ($dblogdata['ip']->ip_address==$serverdata['ip_address'])  && ($dblogdata['details']->redirected_to==$serverdata['path']) && ($diff->i>10)) ){
            $logdata = array(
                    'referer_url'   =>$serverdata['refererurl'],
                    'user_agent'    =>$serverdata['useragent'],
                    'redirected_to' =>$serverdata['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
                $dblogdata['ip']->logdetails()->create($logdata);
            }
        }
        elseif($dblogdata['ip'] && (trim($dblogdata['details'])=='')){
            $logdata = array(
                    'referer_url'   =>$serverdata['refererurl'],
                    'user_agent'    =>$serverdata['useragent'],
                    'redirected_to' =>$serverdata['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
                $dblogdata['ip']->logdetails()->create($logdata);
        }
        else{
            $logdata = array(
                    'referer_url'   =>$serverdata['refererurl'],
                    'user_agent'    =>$serverdata['useragent'],
                    'redirected_to' =>$serverdata['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
            $logcreate= $this->UserlogInterface->create(
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
