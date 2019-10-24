<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Repository\FollowerInterface; 
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Notifications;
use App\Repository\BlogInterface;
use App\Repository\UserInteractionInterface; 
class HomeController extends FrontendController
{
     use HasRoles;
     use Notifiable;

     protected $followerList;

     protected $userAccounts;

     protected $authUser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    function __construct(FollowerInterface $followInterface,BlogInterface $blog,UserInteractionInterface $userInteraction)
    {
         parent::__construct();
         $this->followerList=$followInterface;
         $this->blog=$blog;
         $this->userInteraction=$userInteraction;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $featuredBlog = $this->blog->getAllFeaturedBlog();
        $data['featuredBlog']=$featuredBlog;
        $mostViewed =$this->blog->getAllBlogByViews();
        $data['mostViewed'] = $mostViewed;
        $latest =$this->blog->getLatestAllBlog();
        $data['latest'] = $latest;
        $user ='';
         if(\Auth::check())
        {
            $routeName= ROUTE::currentRouteName();
            
          if($routeName=='api')
          {
            return ($data);
          }
          else
          {
              $data['path']='/home';
              $initialState=json_encode($data);
              $user=$this->user_state_info();
              return view('frontend.home.index',['initialState'=>$data,'user'=>$user])->with(array('featuredBlog'=>$featuredBlog,'mostViewed'=>$mostViewed,'latest'=>$latest));
          }

        }
        return view('frontend.home.index',['initialState'=>$data,'user'=>$user])->with(array('featuredBlog'=>$featuredBlog,'mostViewed'=>$mostViewed,'latest'=>$latest));
    }
    public function blogDetail($code){
      $blogDetails = $this->blog->getBlogByCode($code);
      $blogComment = $this->userInteraction->getCommentByBlogId($blogDetails['id']);
      $data['blogDetails'] =$blogDetails;
      $data['blogComment']  =$blogComment;
      // echo "<pre>";
      // print_r($blogComment);exit;
      $user ='';
         if(\Auth::check())
        {
            $routeName= ROUTE::currentRouteName();
            
          if($routeName=='api')
          {
            return ($data);
          }
          else
          {
              $data['path']='/home';
              $initialState=json_encode($data);
              $user=$this->user_state_info();
              return view('frontend.home.blog_detail',['initialState'=>$data,'user'=>$user])->with(array('blogDetails'=>$blogDetails,'blogComment'=>$blogComment));
          }

        }
        return view('frontend.home.blog_detail',['initialState'=>$data,'user'=>$user])->with(array('blogDetails'=>$blogDetails,'blogComment'=>$blogComment));
    }
    public function test(Request $request)
    {
        $data= $this->blog->getAllBlogByViews();
        print_r($data);
        // return view('frontend.layouts.app');
    }
    public function dashboard()
    {
        if(\Auth::check())
        {
            $routeName= ROUTE::currentRouteName();
            $suggestion=$this->getFollowSuggestions(3);
            $data['followSuggestion']=$suggestion;
          if($routeName=='api')
          {
            return ($data);
          }
          else
          {
              $data['path']='/dashboard';
              $initialState=json_encode($data);
              $user=$this->user_state_info();
              return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
          }

        }
        else
        {
             return redirect()->route('home'); 
        }
    }

    public function getFollowSuggestions($limit=1,$offset=0)
    {
       return $this->followerList->getFollowUserSuggestions($this->authUser,$limit,$offset);
    }
}
