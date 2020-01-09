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
	    		$code='blog_notification';
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
                ->delay(now()->addSeconds($count));
                $count++;
        }
    }
    public function newsletterCategory()
    {
        $this->subs = app()->make('App\Repository\SubscriptionManagerInterface');
        $this->category = app()->make('App\Repository\CategoryInterface');
        $subsData = $this->subs->getActiveSubsByCategory();
        if($subsData){
            foreach ($subsData as $value) {
                $catData = $this->category->getCatById($value->subscribable_id);
                if($catData){
                    $tagsId = $this->category->getTagsIdByCatSlug($catData->slug);
                    if($tagsId){
                        $blog = $this->blog->getBlogByCategoryDaily($tagsId);
                        if($blog){
                            $userData =  $this->user->getById($value->user_id);
                            $code='blog_notification';
                            $data=['NAME'=>$userData->name,'SITENAME'=>config('settings.site_name')];
                            $receiverInfo = ['email'=>$userData->email];
                            $userData->notify(new Notifications($code,$data,$blog,$receiverInfo));
                            echo "success";
                        }else{
                            echo "no blog";
                        }
                    }
                }
            }
        }
    }
    public function newsletterBlogCron()
    {
        $this->subs = app()->make('App\Repository\SubscriptionManagerInterface');
        $subsData = $this->subs->getActiveSubsByAuthor();
        if ($subsData) {
            foreach ($subsData as  $value) {
                $subscribedUser = $this->user->getById($value->subscribable_id);
                $blog = $this->blog->getDailyPublishedBlogByAuthor($subscribedUser);
                if($blog){
                    $userData =  $this->user->getById($value->user_id);
                    $code='blog_notification';
                    $data=['NAME'=>$userData->name,'SITENAME'=>config('settings.site_name')];
                    $receiverInfo = ['email'=>$userData->email];
                    $userData->notify(new Notifications($code,$data,$blog,$receiverInfo));
                    echo "success";
                }else{
                    echo "no blog";
                }
            }
        }
    }
}
