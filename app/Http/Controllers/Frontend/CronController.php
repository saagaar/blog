<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
use App\Repository\AccountInterface; 
use App\Repository\BlogInterface; 
use Illuminate\Support\Facades\File;
use App\Repository\FollowerInterface; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notifications\Notifications;
use Validator;
use App\Jobs\VisitorLog;
use App\Repository\VisitorLogInterface;
class CronController extends FrontendController
{
    use AuthorizesRequests;
    protected $user;
    protected $followerList;
    protected $blog;
    function __construct(AccountInterface $user,BlogInterface $blog,FollowerInterface $followInterface)
    {
        parent::__construct();
         $this->user=$user;
         $this->followerList=$followInterface;
         $this->blog=$blog;
    }
    public function dailyBlogAddEmail()
    {
    	$user=$this->user->getActiveAccounts();
    	foreach ($user as $eachUser) {
    		$blog = $this->blog->getBlogOfFollowingUserDaily($eachUser);
    		if($blog){
	    		$code='blog_registration';
		        $data=['NAME'=>$eachUser->name,'SITENAME'=>config('settings.site_name')];
                $receiverInfo = ['email'=>$eachUser->email];
		        $eachUser->notify(new Notifications($code,$data,$blog,$receiverInfo));
                echo "success";
	    	}else{
                echo "no blog";
            }
	    }
	    
    }	
    public function updateLogCron(){
        $this->VisitorLogInterface = app()->make('App\Repository\VisitorLogInterface');
        $emptyLog = $this->VisitorLogInterface->getUnupdateLog();
        $count = 1;
        foreach ($emptyLog as $key => $value) {
            VisitorLog::dispatch($value->ip_address)
                ;
                $count++;
        }
    }
}
