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
use App\Repository\CategoryInterface;
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
        $return=array();
        $this->user = app()->make('App\Repository\AccountInterface');
        $blog = $this->userInteraction->getAuthorByBlog($code);
        $isLiked=$this->userInteraction->isLiked($this->authUser,$code)->toArray();
         if(empty($isLiked))
         {
            $this->userInteraction->likeBlog($this->authUser,$code);
            $return = $this->userInteraction->getLikeByBlog($code);
            if($blog->user_id){
                $code='like_notification';
                $userdata=$this->user->getUserByUsername($blog->user->username);
                $data=['NAME'=>'<a href="'.route('profile',$this->authUser->username).'">'.$this->authUser->name.'</a>','POST'=>'<a href="'. route('blog.detail' , [$blog->code,str_slug($blog->title)]).'"> POST </a>'];
                $userdata->notify(new Notifications($code,$data,array(),$this->authUser));
            }

         }else{
         	$this->userInteraction->unlikeBlog($this->authUser,$code);
            $return = $this->userInteraction->getLikeByBlog($code);
         }
         return array('status'=>true,'message'=>'success','likes'=>$return);
    }
    
    public function likeCount($code){
    	return $this->userInteraction->getLikeByBlog($code);
    }
    public function createComment(Request $request,$code,BlogInterface $blog){
        $this->user = app()->make('App\Repository\AccountInterface');
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
            if($blogData->user_id){
                $code='comment_notification';
                $userdata=$this->user->getUserByUsername($blogData->user->username);
                $data=['NAME'=>'<a href="'.route('profile',$this->authUser->username).'">'.$this->authUser->name.'</a>','POST'=>'<a href="'. route('blog.detail' , [$blogData->code,str_slug($blogData->title)]).'"> POST </a>'];
                $userdata->notify(new Notifications($code,$data,array(),$this->authUser));
            }
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
    public function saveBlog($code)
    {
        $return=array();
        $isSaved=$this->userInteraction->isSaved($this->authUser,$code);
         if(!($isSaved))
         {
            $this->userInteraction->saveBlog($this->authUser,$code);
            $return = $this->userInteraction->getSaveByBlog($code);
         }else{
            $this->userInteraction->unsaveBlog($this->authUser,$code);
            $return = $this->userInteraction->getSaveByBlog($code);
         }
         return array('status'=>true,'message'=>'success','save'=>$return);
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
            $input['type']      ='1';
            $input['comment']='News Letter Subscription';
            $input['created_at'] = $date->format('Y-m-d H:i:s');
            $subscribe->create($input);
             return array('status'=>true,'message'=>'Subscribed successfully','data'=>'');
    }
    public function newsletterUnsuscribe($email,SubscriptionManagerInterface $subscribe,CategoryInterface $category)
    {
        $navCategory=$category->getCategoryByShowInHome();
        $checkEmail = $subscribe->checkNewsletterSubscriptionInTable($email);
        if($checkEmail){
            $data = array('status'=>2);
            $subscribe->update($checkEmail->id,$data);
            return view('frontend.home.unsubscribe')->with(array('navCategory'=>$navCategory));
        }
        else{
            return redirect()->route('home'); 
         }
    }
    public function userSubscription(Request $request,SubscriptionManagerInterface $subscribe,BlogInterface $blog){
            $request->validate([
            'email' => 'required',
            ]);
            $input = $request->all();
            $blogData= $blog->getBlogByCode($input['code']);
            if($blogData->user){
                $date =date_create();
                if(auth()->user()){
                    $input['user_id']  =Auth()->user()->id;
                }
                else{
                    return redirect()->route('home')->with('error','Please Login First');
                }
                $input['subscribable_type']      ='App\models\Users';
                $input['subscribable_id']      =$blogData->user->id;
                $input['type']      ='3';
                $input['comment']='User Subscription';
                $input['created_at'] = $date->format('Y-m-d H:i:s');
                $subscribe->create($input);
                return array('status'=>true,'message'=>'Subscribed successfully','data'=>'');
            }
    }
    public function categorySubscription(Request $request,SubscriptionManagerInterface $subscribe,CategoryInterface $category){
            $request->validate([
            'email' => 'required',
            ]);
            $input = $request->all();
            $categoryData= $category->getCatBySlug($input['slug']);
            if($categoryData){
                $date =date_create();
                if(auth()->user()){
                    $input['user_id']  =Auth()->user()->id;
                }
                else{
                    return redirect()->route('home')->with('error','Please Login First');
                }
                $input['subscribable_type']      ='App\models\Categories';
                $input['subscribable_id']      =$categoryData->id;
                $input['type']      ='3';
                $input['comment']='Category Subscription';
                $input['created_at'] = $date->format('Y-m-d H:i:s');
                $subscribe->create($input);
                return array('status'=>true,'message'=>'Subscribed successfully','data'=>'');
            }
    }
    public function testinglike($code){
        $user = app()->make('App\Repository\AccountInterface');
        $blogdata = $this->userInteraction->getLikeByBlog($code);
        echo "<pre>";
    	print_r($blogdata->user->username);
    }
}
