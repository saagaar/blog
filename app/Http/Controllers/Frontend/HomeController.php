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
use App\Repository\ShareInterface;
use App\Repository\CategoryInterface;
use App\Repository\UserInteractionInterface; 
use App\Repository\UserInterestInterface; 
use App\Repository\TagInterface;
use App\Repository\TestimonialInterface;  
use App\Repository\ServiceInterface;
use App\Repository\SiteoptionInterface;
use App\Repository\ClientInterface;
use App\Repository\BannerInterface;
use Session;

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
    public function landingPage()
    {
        $address= $this->address;
        $websiteLogo= $this->websiteLogo;
        $siteName=$this->siteName;
        $address=$this->address;
        $contactNumber=$this->contactNumber;
        $facebookId=$this->facebookId;
        $twitterId=$this->twitterId;
        $linkedinId=$this->linkedinId;
        $websiteUrl=$this->websiteUrl;
        $services=$this->services();
        $category=$this->category->getCategoryByWeight();
        $CategoryByWeight=$category->pluck('cat')->toArray();
        $testimonialDetails=$this->testimonialDetails();
        $client=$this->client();
        $banner=$this->bannerTagLine(); 

        return view('frontend.home.landing-page')->with(array('services'=>$services,'testimonialDetails'=>$testimonialDetails,'siteName'=>$siteName,'contactNumber'=>$contactNumber,'address'=>$address,'CategoryByWeight'=>$CategoryByWeight,'client'=>$client,'banner'=>$banner,'websiteLogo'=>$websiteLogo,'facebookId'=>$facebookId,'twitterId'=>$twitterId,'linkedinId'=>$linkedinId,'websiteUrl'=>$websiteUrl));
    }

    public function index(Request $request)
    {
      
         $data=array();
         $limit=$this->perPage;
        $featuredBlog = $this->blog->getAllFeaturedBlog(4);
        $websiteLogo=$this->websiteLogo;
        // $data['featuredBlog']=$featuredBlog;
        // $mostViewed =$this->blog->getAllBlogByViews();
        // $data['mostViewed'] = $mostViewed;
        $popular =$this->blog->getPopularBlog(4);
        // $data['popular'] = $popular;
        $featuredForMember = $this->blog->getAllFeaturedForMember(4);
        // $data['featuredForMember']=$featuredForMember;
        $latest =$this->blog->getLatestAllBlog($limit);
        // $data['latest'] = $latest;
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
              // return view('frontend.home.index',['initialState'=>$data,'user'=>$user])->with(array('featuredBlog'=>$featuredBlog,'latest'=>$latest,'popular'=>$popular,'featuredForMember'=>$featuredForMember,'likes'=>$likes,'navCategory'=>$navCategory));
          }
        }

        
        return view('frontend.home.index',['initialState'=>$data,'user'=>$user])->with(array('featuredBlog'=>$featuredBlog,'latest'=>$latest,'popular'=>$popular,'featuredForMember'=>$featuredForMember,'likes'=>$likes,'navCategory'=>$navCategory,'websiteLogo'=>$websiteLogo));
    }

    public function blogDetail($code,Request $request){

      $blogDetails = $this->blog->getBlogByCode($code);
      $prev = $this->blog->getAll()->where('id', '>',$blogDetails['id'])->orderBy('id','asc')->first();
      $next = $this->blog->getAll()->where('id', '<', $blogDetails['id'])->orderBy('id','desc')->first();
      $blogComment = $this->userInteraction->getCommentByBlogId($blogDetails['id']);
      $relatedBlog = $this->blog->relatedBlogBycode($code);
      $navCategory=$this->category->getCategoryByShowInHome();
      $likes=$this->blog->getLikesOfBlogByUser($this->authUser);
      $data['blogDetails'] =$blogDetails;
      $data['blogComment']  =$blogComment;
      $user ='';
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
          }
        }

        $this->blog->updateBlogViewCount($blogDetails);
        return view('frontend.home.blog_detail',['initialState'=>$data,'user'=>$user])->with(array('blogDetails'=>$blogDetails,'blogComment'=>$blogComment,'prev'=>$prev,'next'=>$next,'relatedBlog'=>$relatedBlog,'websiteLogo'=>$this->websiteLogo,'likes'=>$likes,'navCategory'=>$navCategory));
    }

    public function resizeImage($code,$width,$name)
    {
        $imagePath=public_path(). '/uploads/blog/'.$code.'/'.$name;
        if(File::exists($imagePath))
        {
           $img = Image::make($imagePath);
          $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
          return $img->response('jpg'); 
        }
       abort(404);
    }

    public function blogByCategory($slug,UserInterestInterface $userInterest){
      $data=array();
      $tagsIds = $this->category->getTagsIdByCatSlug($slug);
      $blogByCategory = $this->blog->getBlogByCategory($tagsIds);
      $blogCountinCategory = $this->blog->getBlogCountByCategory($tagsIds);
      $category =$this->category->getCatBySlug($slug);
      $websiteUrl=$this->websiteUrl;
      $categories=array();
      if($this->authUser)
      {
         $cat= $userInterest->isInterest($this->authUser,$category->id) ;
         if($cat)
          $categories[]=$cat->slug;
      }
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
              return view('frontend.home.blog_listing',['initialState'=>$data,'user'=>$user])->with(array('blogByCategory'=>$blogByCategory,'totalBlogsCount'=>$blogCountinCategory,'category'=>$category,'navCategory'=>$navCategory,'websiteLogo'=>$this->websiteLogo,'userCategory'=>$categories));
          }
        }
       return view('frontend.home.blog_listing',['initialState'=>$data,'user'=>$user])->with(array('blogByCategory'=>$blogByCategory,'category'=>$category,'totalBlogsCount'=>$blogCountinCategory,'navCategory'=>$navCategory,'websiteLogo'=>$websiteUrl));
    }
    public function getBlogByCategory($slug=false,Request $request){
      try
      {
        if(!$slug)
            throw new Exception("No Categories Selected", 1);
          $limit=$this->perPage;
          $offset=$request->get('page')*$limit;
          $tagsIds = $this->category->getTagsIdByCatSlug($slug);
          $blogByCategory = $this->blog->getBlogByCategory($tagsIds,$limit,$offset);
          return array('status'=>true,'data'=>$blogByCategory,'message'=>'');
      }
      catch(Exception $e)
      {
          return array('status'=>false,'message'=>$e->getMessage());
      }
    }
    public function getLatestBlog(Request $request){
      try
      {
          $limit=$this->perPage;
          $offset=$request->get('page')*$limit;
          $latest = $this->blog->getLatestAllBlog($limit,$offset);
          return array('status'=>true,'data'=>$latest,'message'=>'');
      }
      catch(Exception $e)
      {
          return array('status'=>false,'message'=>$e->getMessage());
      }
    }
    public function blogListBySlug($slug,Request $request)
    {
        $data=array();
        $blog=array();
        if($slug=='all-featured')
          $blog = $this->blog->getAllFeaturedBlog();
        elseif($slug=='popular')
          $blog =$this->blog->getPopularBlog();
        elseif($slug=='featured-for-member')
          $blog = $this->blog->getAllFeaturedForMember();
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
          }

        }
        return view('frontend.home.blog_listingbyfeature',['initialState'=>$data,'user'=>$user])->with(array('blogs'=>$blog,'slug'=>$slug,'likes'=>$likes,'navCategory'=>$navCategory,'websiteLogo'=>$this->websiteUrl));
    }
    public function getBlogListBySlug($slug=false,Request $request){
      try
      {
        if(!$slug)
            throw new Exception("No Categories Selected", 1);
          $limit=$this->perPage;
          $offset=$request->get('page')*$limit;
          $blog=array();
          if($slug=='all-featured'){
            $blog = $this->blog->getAllFeaturedBlog($limit,$offset);
          }
          elseif($slug=='popular'){
            $blog =$this->blog->getPopularBlog($limit,$offset);
          }
          elseif($slug=='featured-for-member'){
            $blog = $this->blog->getAllFeaturedForMember($limit,$offset);
          }
          return array('status'=>true,'data'=>$blog,'message'=>'');
        
      }
      catch(Exception $e)
      {

          return array('status'=>false,'message'=>$e->getMessage());
      }
    }
    public function test(ShareInterface $share)
    {
       $blogCode='5da95a60500cc2da';
       $data = $share->incrementFbShare($blogCode);
        print_r($data);
        // return view('frontend.layouts.app');
    }
    public function share(Request $request,ShareInterface $share){
      try{
        $blogCode = $request->code;
        $media=$request->media;
        if($media=='facebook'){
          $share->incrementFbShare($blogCode);
          return array('status'=>true,'data'=>'','message'=>'Shared successfully');
        }
      }catch(Exception $e)
      {
          return array('status'=>false,'message'=>$e->getMessage());
      }
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
        if($search)
        {
          $searchedTags=$tag->getTag($search);
          return response()->json(['status'=>true,'data'=>$searchedTags,'message'=>'Tag Data Received']);    
        }
        else
        {
          return response()->json(['status'=>false,'message'=>'No Tags found']);    
        }
    }
    public function services()
    {

      $serviceInterface = app()->make('App\Repository\ServiceInterface');
      $service=$serviceInterface->getServicesDetails();
      return $service;
    }
   public function testimonialDetails()
    { 
      $testimonial = app()->make('App\Repository\TestimonialInterface');
      $testimonialDetails= $testimonial->getActiveTestimonial();
      return $testimonialDetails;
   }  
  
   public function client()
   {
     $client= app()->make('App\Repository\ClientInterface');
     $clientDetails=$client->getClients();
     return $clientDetails;
   }
   public function bannerTagLine()
   {
     $banner= app()->make('App\Repository\BannerInterface');
     $bannerDetails=$banner->getBannerTagLine();
     return $bannerDetails;
   }
} 