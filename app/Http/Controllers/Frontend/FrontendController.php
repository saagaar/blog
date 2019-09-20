<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Repository\SiteoptionsInterface;
use Illuminate\Support\Facades\Route;
use App\Models\Userlogs;
use App\Services\VisitorInfo;
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
        $this->userLogInterface=$this->UserlogInterface = app()->make('App\Repository\UserlogInterface');
        $this->siteSettings=$SiteoptionsInterface->GetSiteInfo();
        $this->visitorInfo =  new visitorInfo();
        $this->siteName =  $this->siteSettings->site_name;
        $this->contactEmail =  $this->siteSettings->contact_email;
        $this->contactName =  $this->siteSettings->contact_name;
        $this->contactNumber =  $this->siteSettings->contact_number;
        $this->maintainence =  $this->siteSettings->maintainence;
        $this->userRequiresActivation  =  $this->siteSettings->user_requires_activation;
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
        $this->websiteMode=$this->siteSettings->mode;
        $this->save_visitor_info();
       
        date_default_timezone_set('Asia/Kathmandu');
       
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
  
    

    public function save_visitor_info()
    {
        $serverData = $this->visitorInfo->getServerInfo();
        $ipAddress=$serverData['ip_address'];  
        $dblogdata=$this->userLogInterface->getLogbyIpAddressAndURL($serverData['ip_address'],$serverData['path']);
       if($dblogdata && (trim($dblogdata['details'])!='')){
            $start = date_create($dblogdata['details']->visit_date);
        $end = date_create(date("Y-m-d H:i:s"));
        $diff=date_diff($end,$start);
        
        if((($dblogdata['ip']->ip_address==$serverData['ip_address'])  && ($dblogdata['details']->redirected_to!=$serverData['path'])) || ( ($dblogdata['ip']->ip_address==$serverData['ip_address'])  && ($dblogdata['details']->redirected_to==$serverData['path']) && ($diff->i>10)) ){
            $logdata = array(
                    'referer_url'   =>$serverData['refererurl'],
                    'user_agent'    =>$serverData['useragent'],
                    'redirected_to' =>$serverData['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
                $dblogdata['ip']->logdetails()->create($logdata);
            }
        }
        elseif ($dblogdata && trim($dblogdata['details'])=='') {
            $logdata = array(
                    'referer_url'   =>$serverData['refererurl'],
                    'user_agent'    =>$serverData['useragent'],
                    'redirected_to' =>$serverData['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
            $dblogdata['ip']->logdetails()->create($logdata);
        }
        else{
            $logdata = array(
                    'referer_url'   =>$serverData['refererurl'],
                    'user_agent'    =>$serverData['useragent'],
                    'redirected_to' =>$serverData['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
            $logcreate= $this->userLogInterface->create(
                   array(
                    'ip_address'           =>$serverData['ip_address'],
                   )
                );
            $logcreate->logdetails()->create($logdata);
        }
        VisitorLog::dispatch($this->UserlogInterface,$ipAddress);

    }
}
