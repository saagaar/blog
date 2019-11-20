<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Userlogs;
use App\Services\VisitorInfo;
use App\Jobs\VisitorLog;
use App\Repository\VisitorlogInterface;
use App\Repository\PermissionInterface;
use Illuminate\Support\Facades\Auth;

class FrontendController extends BaseController
{
    Protected $siteSettings;

    Protected $VisitorlogInterface;

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
     * website visitor's ip
     *
     * @return void
     */
    Protected $ipInfoService;
     /***
    * This email is used to send email by client to admin of site
    * @type=email
    */
    Protected $permission;
    Protected $contactEmail;

    Protected $perPage=10;
    Protected $apiPerPage=8;
    public function __construct()
    {
        $this->VisitorLogInterface=$this->VisitorInterface = app()->make('App\Repository\VisitorLogInterface');
        $this->permission=$this->PermissionInterface = app()->make('App\Repository\PermissionInterface');
        $this->visitorInfo =  new visitorInfo();
        $this->siteName =  config('settings.site_name');
        $this->contactEmail =  config('settings.contact_email');
        $this->systemEmail =  config('settings.system_email');
        $this->contactName = config('settings.contact_name');
        $this->contactNumber = config('settings.contact_number'); 
        $this->maintainence = config('settings.maintainence');
        $this->userRequiresActivation  =  config('settings.user_requires_activation');
        $this->blogRequiresActivation = config('settings.blog_requires_activation');
        $this->facebookId =config('settings.facebook_id');  
        $this->linkedinId = config('settings.linkedin_id');
        $this->twitterId = config('settings.twitter_id'); 
        $this->instagramId = config('settings.instagram_id');
        $this->youtube =  config('settings.youtube');
        $this->timezone = config('settings.timezone');
        $this->currencySign = config('settings.currency_sign');
        $this->address = config('settings.address');
        $this->city = config('settings.city'); 
        $this->state = config('settings.state'); 
        $this->country = config('settings.country');
        $this->websiteMode=config('settings.mode');

        // $this->save_visitor_info();
       
        date_default_timezone_set('Asia/Kathmandu');
        
        // if($this->websiteMode=='3')
        // {
        //     exit('Sorry we are maintaining..It is a regular maintainence');
        // }
        // if($this->websiteMode=='2'){
        //     exit('sorry we currently offline');
        // }
        $this->middleware(function ($request, $next) {
        $this->authUser= \Auth::user();
            return $next($request);
        });

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $not = $this->authUser->Notifications()->take(10)->get();

        print_r($not);exit;        
        return view('frontend.home.index');
    }
    public function getAllPermissionsAttribute() {
      $permissions = [];
        foreach ($this->permission->getAll()->get() as $permission) {
          if (Auth::user()->can($permission->name)) {
            $permissions[] = $permission->name;
          }
        }
        return $permissions;
    }
    public function user_state_info(){
       $followerList = app()->make('App\Repository\FollowerInterface');
       $account = app()->make('App\Repository\AccountInterface');
        if(\Auth::check())
        {
            $user =$this->authUser;
            $user->followersCount=$followerList->getFollowersCount($this->authUser);
            $user->followingCount=$followerList->getFollowingsCount($this->authUser);
            $user->unReadNotificationsCount=$this->authUser->unreadNotifications()->count() ;
            $user->notifications=$account->getUsersNotification($this->authUser,$this->apiPerPage);
            $user->blogCount=$this->authUser->blogs()->count();
            $user->root_url=url('/');
            
            $user=$user->toArray();
            $user['permissions']= $this->getAllPermissionsAttribute();    
            // $user['roles']=$this->authUser->roles->first()->name;
            return $user;
        }
        else{
            return redirect()->route('home'); 
        }
    }

    // public function 

    public function save_visitor_info()
    {
        $serverData = $this->visitorInfo->getServerInfo();

        $ipAddress=$serverData['ip_address'];  
        $dblogdata=$this->VisitorLogInterface->getLogbyIpAddressAndURL($serverData['ip_address'],$serverData['path']);
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
                $dblogdata['ip']->visitordetails()->create($logdata);
            }
        }
        elseif ($dblogdata && trim($dblogdata['details'])=='') {
            $logdata = array(
                    'referer_url'   =>$serverData['refererurl'],
                    'user_agent'    =>$serverData['useragent'],
                    'redirected_to' =>$serverData['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
            $dblogdata['ip']->visitordetails()->create($logdata);
        }
        else{
            $logdata = array(
                    'referer_url'   =>$serverData['refererurl'],
                    'user_agent'    =>$serverData['useragent'],
                    'redirected_to' =>$serverData['path'],
                    'visit_date'   =>date("Y-m-d H:i:s"),
                );
            $logcreate= $this->VisitorLogInterface->create(
                   array(
                    'ip_address'           =>$serverData['ip_address'],
                   )
                );
            $logcreate->visitordetails()->create($logdata);
        }
        VisitorLog::dispatch($this->VisitorlogInterface,$ipAddress);

    }
}
