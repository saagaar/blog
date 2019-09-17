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
    Protected $ipInfoService;

    public function __construct()
    {
        $SiteoptionsInterface = app()->make('App\Repository\SiteoptionsInterface');
        $this->UserlogInterface = app()->make('App\Repository\UserlogInterface');
        $this->siteSettings=$SiteoptionsInterface->GetSiteInfo();
        $this->siteName =  $this->siteSettings->site_name;
        $this->contactEmail =  $this->siteSettings->contact_email;
        $this->contactName =  $this->siteSettings->contact_name;
        $this->contactNumber =  $this->siteSettings->contact_number;
        $this->mode =  $this->siteSettings->mode;
        $this->maintainence =  $this->siteSettings->maintainence;
        $this->userActivation =  $this->siteSettings->user_requires_activation;
        $this->blogRequiresActivation =  $this->siteSettings->blog_requires_activation;
        $this->facebookId =  $this->siteSettings->facebook_id;
        $this->linkedinId =  $this->siteSettings->linkedin_id;
        $this->twitterId =  $this->siteSettings->twitter_id;
        $this->instagramId =  $this->siteSettings->instagram_id;
        $this->youtube =  $this->siteSettings->youtube;
        $this->timezone =  $this->siteSettings->timezone;
        $this->currencySign =  $this->siteSettings->currency_sign;
        $this->address =  $this->siteSettings->address;
        $this->city =  $this->siteSettings->city;
        $this->state =  $this->siteSettings->state;
        $this->country =  $this->siteSettings->country;
        $this->savelog();
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
    public function savelog(){
        $info=new VisitorInfo();
        $serverdata =  $info->visitorsIp();
        date_default_timezone_set('Asia/Kathmandu');
        $dblogdata=$this->UserlogInterface->getLogbyIpAddressAndURL($serverdata['ip_address'],$serverdata['path']);

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
