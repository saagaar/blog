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
use App\Repository\CategoryInterface;
use App\Repository\UserInteractionInterface; 
use App\Repository\TagInterface;

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
   
    function __construct(FollowerInterface $followInterface,BlogInterface $blog,CategoryInterface $category,UserInteractionInterface $userInteraction)
    {
         parent::__construct();
         $this->followerList=$followInterface;
         $this->blog=$blog;
         $this->category=$category;
         $this->userInteraction=$userInteraction;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data=array();
        $featuredBlog = $this->blog->getAllFeaturedBlog();
        // $data['featuredBlog']=$featuredBlog;
        $mostViewed =$this->blog->getAllBlogByViews();
        // $data['mostViewed'] = $mostViewed;
        $latest =$this->blog->getLatestAllBlog();
        // $data['latest'] = $latest;
        $popular =$this->blog->getPopularBlog();
        // $data['popular'] = $popular;
        $featuredForMember = $this->blog->getAllFeaturedForMember();
        // $data['featuredForMember']=$featuredForMember;
        $navCategory=$this->category->getCategoryByShowInHome();
        $likes='';
        $user ='';
        $data['path']='/home';
         if(\Auth::check())
        {
          $likes=$this->blog->getLikesOfBlogByUser($this->authUser);
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
              return view('frontend.home.index',['initialState'=>$data,'user'=>$user])->with(array('featuredBlog'=>$featuredBlog,'mostViewed'=>$mostViewed,'latest'=>$latest,'popular'=>$popular,'featuredForMember'=>$featuredForMember,'likes'=>$likes,'navCategory'=>$navCategory));
          }

        }
        return view('frontend.home.index',['initialState'=>$data,'user'=>$user])->with(array('featuredBlog'=>$featuredBlog,'mostViewed'=>$mostViewed,'latest'=>$latest,'popular'=>$popular,'featuredForMember'=>$featuredForMember,'likes'=>$likes,'navCategory'=>$navCategory));
    }
    public function blogDetail($code){
      $blogDetails = $this->blog->getBlogByCode($code);
      $prev = $this->blog->getAll()->where('id', '>',$blogDetails['id'])->orderBy('id','asc')->first();
      $next = $this->blog->getAll()->where('id', '<', $blogDetails['id'])->orderBy('id','desc')->first();
      // print_r($next);exit;
      $blogComment = $this->userInteraction->getCommentByBlogId($blogDetails['id']);
      $relatedBlog = $this->blog->relatedBlogBycode($code);
      $navCategory=$this->category->getCategoryByShowInHome();
      $likes=$this->blog->getLikesOfBlogByUser($this->authUser);
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
              return view('frontend.home.blog_detail',['initialState'=>$data,'user'=>$user])->with(array('blogDetails'=>$blogDetails,'blogComment'=>$blogComment,'prev'=>$prev,'next'=>$next,'relatedBlog'=>$relatedBlog,'likes'=>$likes,'navCategory'=>$navCategory));
          }

        }
        return view('frontend.home.blog_detail',['initialState'=>$data,'user'=>$user])->with(array('blogDetails'=>$blogDetails,'blogComment'=>$blogComment,'prev'=>$prev,'next'=>$next,'relatedBlog'=>$relatedBlo,'likes'=>$likes,'navCategory'=>$navCategory));
    }
    public function blogByCategory($slug){
      $blogByCategory = $this->blog->getBlogByCategory($slug);
      // $blogCount = $this->blog->getBlogCount($slug);
      $category =$this->category->getCatBySlug($slug);
      $navCategory=$this->category->getCategoryByShowInHome();
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
              return view('frontend.home.blog_listing',['initialState'=>$data,'user'=>$user])->with(array('blogByCategory'=>$blogByCategory,'category'=>$category,'navCategory'=>$navCategory));
          }
        }
       return view('frontend.home.blog_listing',['initialState'=>$data,'user'=>$user])->with(array('blogByCategory'=>$blogByCategory,'category'=>$category,'navCategory'=>$navCategory));
    }
    public function getBlogByCategory($slug=false,Request $request){
      try{
        if(!$slug)
            throw new Exception("No Categories Selected", 1);
          $limit=$this->perPage;
          $offset=$request->get('offset');
          $blogByCategory = $this->blog->getBlogByCategory($slug,$limit,$offset);
          return $blogByCategory;
        
      }
      catch(Exception $e)
      {

          return array('status'=>false,'message'=>$e->getMessage());
      }
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
            $blogByFollowing =$this->blog->getBlogOfFollowingUser($this->authUser);
            $data['blogByFollowing'] = $blogByFollowing;
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


    public function getTagName(TagInterface $tag,Request $request)
    {
         $search=$request->post('name');             
         if($search){
            $searchedTags=$tag->getTag($search);
            return response()->json(['status'=>true,'data'=>$searchedTags,'message'=>'Tag Data Received']);    
          }
          else{
           return response()->json(['status'=>false,'message'=>'No Tags found']);    
          }
    }
}
