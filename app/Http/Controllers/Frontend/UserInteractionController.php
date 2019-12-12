<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Repository\TagInterface;
use Validator,Redirect,Response,File;
use App\Notifications\Notifications;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repository\BlogInterface;
use App\Repository\ContactInterface;
use App\Repository\AccountInterface;
use App\Repository\UserInteractionInterface;  
use App\Repository\SubscriptionManagerInterface;
class UserInteractionController extends FrontendController
{
    protected $data;
	protected $userInteraction;

    use AuthorizesRequests;

    function __construct(UserInteractionInterface $userInteraction)
    {
        parent::__construct();
        $this->userInteraction=$userInteraction;
    }
    public function likeBlog($code)
    {
        $this->user = app()->make('App\Repository\AccountInterface');
        $blog = $this->userInteraction->getLikeByBlog($code);
        $isLiked=$this->userInteraction->isLiked($this->authUser,$code)->toArray();
         if(empty($isLiked))
         {
            $this->userInteraction->likeBlog($this->authUser,$code);
            if($blog->user_id){
                $code='like_notification';
                $userdata=$this->user->getUserByUsername($blog->user->username);
                $data=['NAME'=>$this->authUser->name,'URL'=>route('blog.detail' , $blog->code)];
                $userdata->notify(new Notifications($code,$data));
            }
         }else{
         	$this->userInteraction->unlikeBlog($this->authUser,$code);
         }
         
         return array('status'=>true,'message'=>'success','likes'=>$blog);
    }
    
    public function likeCount($code){
    	return $this->userInteraction->getLikeByBlog($code);
    }
    public function createComment(Request $request,$code,BlogInterface $blog){
        if($code){
            $request->validate([
            'comment' => 'required',
            ]);
            $input = $request->all();
            $date =date_create();
            $input['user_id']  =Auth()->user()->id;
            $blogData = $blog->getBlogByCode($code);
            $input['blog_id'] = $blogData->id;
            $input['created_at'] = $date->format('Y-m-d H:i:s');
            $this->userInteraction->createCommment($input);
             return array('status'=>true,'message'=>'success','data'=>array('comment'=>$input['comment'],'created_at'=>$input['created_at']));
        }
    }
    public function contactForm(Request $request,ContactInterface $contact){
            $request->validate([
            'name' => 'required',
            'email'=>'required',
            'phone'=>'required',
            'message'=>'required'
            ]);
            $input = $request->all();
            $date =date_create();
            $input['created_at'] = $date->format('Y-m-d H:i:s');
            $contact->create($input);
             return array('status'=>true,'message'=>'Form submitted successfully','data'=>'');
    }
    public function newsletter(Request $request,SubscriptionManagerInterface $subscribe){
            $request->validate([
            'email' => 'required',
            ]);
            $input = $request->all();
            $date =date_create();
            if(auth()->user()){
                $input['user_id']  =Auth()->user()->id;
            }
            else{
                $input['user_id']  =Null;
            }
            $input['comment']='News Letter Subscription';
            $input['created_at'] = $date->format('Y-m-d H:i:s');
            $subscribe->create($input);
             return array('status'=>true,'message'=>'Subscribed successfully','data'=>'');
    }
    public function testinglike($code){
        $user = app()->make('App\Repository\AccountInterface');
        $blogdata = $this->userInteraction->getLikeByBlog($code);
        echo "<pre>";
    	print_r($blogdata->user->username);
    }
}
