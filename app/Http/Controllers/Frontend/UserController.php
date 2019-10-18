<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
use App\Repository\AccountInterface; 
use App\Repository\BlogInterface; 
use App\Repository\FollowerInterface; 
class UserController extends FrontendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user;
    protected $followerList;
    function __construct(AccountInterface $user,FollowerInterface $followInterface)
    {
        parent::__construct();
         $this->user=$user;
         $this->followerList=$followInterface;
    }
    public function myBlogs(BlogInterface $blog,Request $request)
    { 
      // sleep(10);
      if(\Auth::check())
        {
            $routeName= Route::currentRouteName();
            $myBlogs=$blog->getBlogByUserId($this->authUser->id);

           if($routeName=='api')
           {
              $search=$request->get('search');
              $filterBy=$request->get('filter_by');
              $sortBy=$request->get('sort_by');
              if($filterBy)
                 $myBlogs=$myBlogs->where('save_method',$filterBy);
              if($search)
                $myBlogs=$myBlogs->where('title' ,'like','%'.$search.'%');
              if($sortBy)
                $myBlogs=$myBlogs->orderBy('created_at',strtoupper($sortBy));
            
                $data['blogList']=$myBlogs->paginate($this->perPage);
              return ($data);
           }
           else
           {

              $data['blogList']=$myBlogs->paginate($this->perPage);

              $data['path']='/blog/list';
              $initialState=json_encode($data);
              $user=$this->user_state_info();
              return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
           }
        }else{
           return redirect()->route('home'); 
        } 
    }
   
    public function followings()
    {
        if(\Auth::check())
        {
            $routeName= ROUTE::currentRouteName();
            $suggestion=$this->getFollowSuggestions(3);
            $followings = $this->followerList->getAllFollowings($this->authUser);
            $data['followSuggestion']=$suggestion;
            $data['followings'] = $followings;
          if($routeName=='api')
          {
            return ($data);
          }
          else
          {
              $data['path']='/followings';
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
    public function followers()
    {
        if(\Auth::check())
        {
            $routeName= ROUTE::currentRouteName();
            $followers = $this->followerList->getAllFollowers($this->authUser);
            $followings = $this->followerList->getAllFollowings($this->authUser)->pluck('username');
            $data['followers'] = $followers;
            $data['followings'] = $followings;
            // echo "<pre>";
            // print_r($data);exit;
          if($routeName=='api')
          {
            return ($data);
          }
          else
          {
              $data['path']='/followers';
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
    public function followUser($username,$offset=false)
    {
        $isFollowing=$this->followerList->isFollowingByUsername($this->authUser,$username);
         if(!($isFollowing))
         {
            $this->followerList->followUser($this->authUser,$username);
         }  
         return array('status'=>true,'message'=>$this->getFollowSuggestions(1,$offset));
    }
    public function unFollowUser($username,$offset=false)
    {
        $isFollowing=$this->followerList->isFollowingByUsername($this->authUser,$username,$offset);
         if(($isFollowing))
         {
            $this->followerList->unfollowUser($this->authUser,$username);
         }  
        return array('status'=>true,'message'=>'');
    }
    public function getFollowSuggestions($limit=1,$offset=0)
    {
       return $this->followerList->getFollowUserSuggestions($this->authUser,$limit,$offset);
    }
    public function profile(BlogInterface $blog,Request $request)
    { 
      if(\Auth::check())
        {
      // sleep(10);
            $routeName= Route::currentRouteName();
            $myBlogs=$blog->getActiveBlogByUserId($this->authUser->id);

           if($routeName=='api')
           {
              $search=$request->get('search');
              // $filterBy=$request->get('filter_by');
              $sortBy=$request->get('sort_by');
              // if($filterBy)
              //    $myBlogs=$myBlogs->where('save_method',$filterBy);
              if($search)
                $myBlogs=$myBlogs->where('title' ,'like','%'.$search.'%');
              if($sortBy)
                $myBlogs=$myBlogs->orderBy('created_at',strtoupper($sortBy));
            
                $data['blogList']=$myBlogs->paginate($this->perPage);
              return ($data);
           }
           else
           {
              
              $data['blogList']=$myBlogs->paginate($this->perPage);

              $data['path']='/profile';
              $initialState=json_encode($data);
              $user=$this->user_state_info();
              return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
           }
    }else{
      return redirect()->route('home'); 
    }
  }

}
