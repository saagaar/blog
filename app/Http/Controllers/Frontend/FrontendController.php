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
        $this->siteName =  $this->siteSettings->site_name;
        $this->contactEmail =  $this->siteSettings->contact_email;
        $this->contactName =  $this->siteSettings->contact_name;
        $this->contactNumber =  $this->siteSettings->contact_number;
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
        // $this->savelog();
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
    }
}
