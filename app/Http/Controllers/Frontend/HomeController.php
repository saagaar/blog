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
use App\Repository\BlogVisitInterface;
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
   
    function __construct(FollowerInterface $followInterface,BlogInterface $blog,CategoryInterface $category,UserInteractionInterface $userInteraction){
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
    public function landingPage(){
        $address= $this->address;
        $websiteLogo= $this->websiteLogo;
        $siteName=$this->siteName;
        $city=$this->city;
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
        $this->seo = app()->make('App\Repository\SeoInterface');
        
        $seo =array();
        $seo = $this->seo->getSeoBySlug('landing-page');
        return view('frontend.home.landing-page')->with(array('services'=>$services,'testimonialDetails'=>$testimonialDetails,'siteName'=>$siteName,'contactNumber'=>$contactNumber,'address'=>$address,'CategoryByWeight'=>$CategoryByWeight,'client'=>$client,'banner'=>$banner,'websiteLogo'=>$websiteLogo,'facebookId'=>$facebookId,'twitterId'=>$twitterId,'linkedinId'=>$linkedinId,'websiteUrl'=>$websiteUrl,'city'=>$city,'seo'=>$seo));
    }
    public function index(Request $request){
       $this->seo = app()->make('App\Repository\SeoInterface');
       $seo =array();
       $seo = $this->seo->getSeoBySlug('home');
       $savedBlog = array();
       $data=array();
       $limit=$this->perPage;
       $homeLimit = 4;
        $featuredBlog = $this->blog->getAllFeaturedBlog($homeLimit);
        $websiteLogo=$this->websiteLogo;
        $popular =$this->blog->getPopularBlog($homeLimit);
        $featuredForMember = $this->blog->getAllFeaturedForMember($homeLimit);
        $latest =$this->blog->getLatestAllBlog($limit);
        $navCategory=$this->category->getCategoryByShowInHome();
        $liked=array();
        $likes=array();
        $user ='';
        $data['path']='/home';
        if(\Auth::check())
        {
            $likes=$this->blog->getLikesOfBlogByUser($this->authUser);
            $liked = $this->blog->getBlogCodeByLike($likes);
            $savedBlogId = $this->blog->getSaveBlogByUser($this->authUser);
            $savedBlog = $this->blog->getBlogCodeBySave($savedBlogId);
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
      return view('frontend.home.index',['initialState'=>$data,'user'=>$user])->with(array('featuredBlog'=>$featuredBlog,'latest'=>$latest,'popular'=>$popular,'featuredForMember'=>$featuredForMember,'likes'=>$likes,'navCategory'=>$navCategory,'websiteLogo'=>$websiteLogo,'savedBlog'=>$savedBlog,'userLiked'=>$liked,'seo'=>$seo));
    }

    public function blogDetail($code,$slug,Request $request){
      $this->seo = app()->make('App\Repository\SeoInterface');
      $seo =array();
      $seo = $this->seo->getSeoBySlug('blog-details');
      $this->blogVisit = app()->make('App\Repository\BlogVisitInterface');
      $this->share = app()->make('App\Repository\ShareInterface');
      $totalShare = $this->share->getTotalShare($code);
      $blogDetails = $this->blog->getActiveBlogByCode($code);
      $prev = $this->blog->getAll()->where('id', '<',$blogDetails['id'])->where(['save_method'=>2])->orderBy('id','desc')->first();
      $next = $this->blog->getAll()->where('id', '>', $blogDetails['id'])->where(['save_method'=>2])->orderBy('id')->first();
      $blogComment = $this->userInteraction->getCommentByBlogId($blogDetails['id']);
      $relatedBlog = $this->blog->relatedBlogBycode($code);
      $navCategory=$this->category->getCategoryByShowInHome();
      $data['blogDetails'] =$blogDetails;
      $data['blogComment']  =$blogComment;
      $user ='';
      $likes='';
        if(\Auth::check())
        {
          $likes=$this->blog->doUserLikesBlog($this->authUser,$code);
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
        $ip = $_SERVER['REMOTE_ADDR'];
        $ipCheckForDailyViewCount = $this->blogVisit->getIpByBlog($blogDetails,$ip);
        $displayType=$request->get('name');
        if($ipCheckForDailyViewCount && $displayType!='social-share'){
          $account = app()->make('App\Repository\AccountInterface');
          if($this->enable_point_system=='1'){
            $account->pointIncrement($blogDetails->user_id,$this->view_weightage*1);
          }
          $this->blog->updateBlogViewCount($blogDetails);
        }
        return view('frontend.home.blog_detail',['initialState'=>$data,'user'=>$user])->with(array('blogDetails'=>$blogDetails,'blogComment'=>$blogComment,'prev'=>$prev,'next'=>$next,'relatedBlog'=>$relatedBlog,'websiteLogo'=>$this->websiteLogo,'likes'=>$likes,'navCategory'=>$navCategory,'totalShare'=>$totalShare));
    }
    public function resizeImage($code,$width,$name){
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
    public function categoryListing(UserInterestInterface $userInterest)
    {
      $this->seo = app()->make('App\Repository\SeoInterface');
      $seo =array();
      $seo = $this->seo->getSeoBySlug('all-category');
      $data=array();
      $user=array();
      $categories=array();
      $allCategories= $this->category->getAllCategories();
      $navCategory=$this->category->getCategoryByShowInHome();
      if(\Auth::check())
        {
          $routeName= ROUTE::currentRouteName();
          if($routeName=='api')
          {
            return ($data);
          }
          else
          {
              $data['path']='/all/category';
              $initialState=json_encode($data);
              $user=$this->user_state_info();
          }
        }
        return view('frontend.home.category',['initialState'=>$data,'user'=>$user])->with(array('allCategory'=>$allCategories,'navCategory'=>$navCategory,'seo'=>$seo));
    }

    public function blogByCategory($slug,UserInterestInterface $userInterest){
       $this->seo = app()->make('App\Repository\SeoInterface');
      $seo =array();
      $seo = $this->seo->getSeoBySlug('blog-category');
      $savedBlog = array();
      $data=array();
      $tagsIds = $this->category->getTagsIdByCatSlug($slug);
      $blogByCategory = $this->blog->getBlogByCategory($tagsIds);
      $blogCountinCategory = $this->blog->getBlogCountByCategory($tagsIds);
      $category =$this->category->getCatBySlug($slug);
      $liked=array();
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
       $likes='';
        if(\Auth::check())
        {
          $savedBlogId = $this->blog->getSaveBlogByUser($this->authUser);
            $savedBlog = $this->blog->getBlogCodeBySave($savedBlogId);
          $likes=$this->blog->getLikesOfBlogByUser($this->authUser);
          $liked = $this->blog->getBlogCodeByLike($likes);
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
              // return view('frontend.home.blog_listing',['initialState'=>$data,'user'=>$user])->with(array('blogByCategory'=>$blogByCategory,'totalBlogsCount'=>$blogCountinCategory,'category'=>$category,'navCategory'=>$navCategory,'websiteLogo'=>$this->websiteLogo,'userCategory'=>$categories,,'likes'=>$likes));
          }
        }
       return view('frontend.home.blog_listing_by_category',['initialState'=>$data,'user'=>$user])->with(array('blogByCategory'=>$blogByCategory,'totalBlogsCount'=>$blogCountinCategory,'category'=>$category,'navCategory'=>$navCategory,'websiteLogo'=>$this->websiteLogo,'userCategory'=>$categories,'likes'=>$likes,'savedBlog'=>$savedBlog,'userLiked'=>$liked,'seo'=>false));
    }
    
    public function getBlogByCategory($slug=false,Request $request){
      try{
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
      try{
          $limit=$this->perPage;
          $offset=$request->get('page')*$limit;
          $latest = $this->blog->getLatestAllBlog($limit,$offset);
          return array('status'=>true,'data'=>$latest,'message'=>'');
      }
      catch(Exception $e){
          return array('status'=>false,'message'=>$e->getMessage());
      }
    }
    public function blogListBySlug($slug,Request $request){
        $savedBlog=array();
        $data=array();
        $blog=array();
        $this->seo = app()->make('App\Repository\SeoInterface');
        $seo =array();
        if($slug=='all-featured')
        {
          $seo = $this->seo->getSeoBySlug('all-featured');
          $blog = $this->blog->getAllFeaturedBlog();
        }
        elseif($slug=='popular')
        {
          $seo = $this->seo->getSeoBySlug('popular');
          $blog =$this->blog->getPopularBlog();
        }
        elseif($slug=='featured-for-member')
        {
          $seo = $this->seo->getSeoBySlug('featured-for-member');
          $blog = $this->blog->getAllFeaturedForMember();
        }
        $navCategory=$this->category->getCategoryByShowInHome();
        $likes='';
        $user ='';
        $liked=array();
        $data['path']='/home';
        if(\Auth::check())
        {
          $savedBlogId = $this->blog->getSaveBlogByUser($this->authUser);
            $savedBlog = $this->blog->getBlogCodeBySave($savedBlogId);
          $likes=$this->blog->getLikesOfBlogByUser($this->authUser);
          $liked = $this->blog->getBlogCodeByLike($likes);
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
        return view('frontend.home.blog_listingbyfeature',['initialState'=>$data,'user'=>$user])->with(array('blogs'=>$blog,'slug'=>$slug,'likes'=>$likes,'navCategory'=>$navCategory,'websiteLogo'=>$this->websiteUrl,'savedBlog'=>$savedBlog,'userLiked'=>$liked,'seo'=>$seo));
    }
    public function getBlogListBySlug($slug=false,Request $request){
     try{
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
    public function share(Request $request,ShareInterface $share){
      try{
          $blogCode = $request->code;
          $media=$request->media;
          if($media=='facebook'){
            $share->incrementFbShare($blogCode);
            return array('status'=>true,'data'=>'','message'=>'Shared successfully');
          }
          if($media=='twitter'){
            $share->incrementTwShare($blogCode);
            return array('status'=>true,'data'=>'','message'=>'Shared successfully');
          }
        }
        catch(Exception $e)
        {
            return array('status'=>false,'message'=>$e->getMessage());
        }
    }
    public function dashboard(){
        if(\Auth::check()){
            $routeName= ROUTE::currentRouteName();
            $suggestion=$this->getFollowSuggestions(3);
            $data['followSuggestion']=$suggestion;
            $blogByFollowing =$this->blog->getBlogOfFollowingUser($this->authUser);
            $likes=$this->blog->getLikesOfBlogByUser($this->authUser);
            $liked = $this->blog->getBlogCodeByLike($likes);
            $data['userliked'] = $liked;
            $data['blogByFollowing'] = $blogByFollowing;
            if($routeName=='api'){
              return ($data);
            }
            else{
                $data['path']='/dashboard';
                $initialState=json_encode($data);
                $user=$this->user_state_info();
                return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
            }
        }
        else{
             return redirect()->route('home'); 
        }
    }
    public function getBlogOfFollowing(Request $request){
      try{
          $limit=$this->perPage;
          $offset=$request->get('page')*$limit;
          $latest = $this->blog->getBlogOfFollowingUser($this->authUser,$limit,$offset);
          return array('status'=>true,'data'=>$latest,'message'=>'');
      }
      catch(Exception $e)
      {
         return array('status'=>false,'message'=>$e->getMessage());
      }
    }
    public function getFollowSuggestions($limit=1,$offset=0){
       return $this->followerList->getFollowUserSuggestions($this->authUser,$limit,$offset);
    }
    public function getTagName(TagInterface $tag,Request $request){
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
    public function services(){
      $serviceInterface = app()->make('App\Repository\ServiceInterface');
      $service=$serviceInterface->getServicesDetails();
      return $service;
    }
    public function testimonialDetails(){ 
        $testimonial = app()->make('App\Repository\TestimonialInterface');
        $testimonialDetails= $testimonial->getActiveTestimonial();
        return $testimonialDetails;
    }  
    public function client(){
       $client= app()->make('App\Repository\ClientInterface');
       $clientDetails=$client->getClients();
       return $clientDetails;
    }
    public function bannerTagLine(){
       $banner= app()->make('App\Repository\BannerInterface');
       $bannerDetails=$banner->getBannerTagLine();
       return $bannerDetails;
    }
} 