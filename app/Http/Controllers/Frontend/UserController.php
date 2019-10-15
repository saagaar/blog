<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
use App\Repository\AccountInterface; 
use App\Repository\BlogInterface; 

class UserController extends FrontendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user;

    function __construct(AccountInterface $user)
    {
        parent::__construct();
         $this->user=$user;
    }
    public function myBlogs(BlogInterface $blog,Request $request)
    { 
      // sleep(10);
         
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
    }
   
    public function followUser($username,$offset=false)
    {
         $isFollowing=$this->followerList->isFollowingByUsername($this->authUser,$username);
         if(isset($isFollowing))
         {
            $this->followerList->followUser($this->authUser,$username);
         }  
         return array('status'=>true,'message'=>$this->getFollowSuggestions(1,$offset));
    }
    public function unFollowUser($username,$offset=false)
    {
        $isFollowing=$this->followerList->isFollowing($this->authUser,$username,$offset);
         if(($isFollowing))
         {
            $this->followerListlowerList->unfollowUser($this->authUser,$username);
         }  
        return array('status'=>true,'message'=>'');
    }
    public function getFollowSuggestions($limit=1,$offset=0)
    {
     
       return $this->followerList->getFollowUserSuggestions($this->authUser,$limit,$offset);
    }

    public function profile()
    {
            $routeName= Route::currentRouteName();
            // $myBlogs=$blog->getBlogByUserId($this->authUser->id);

           if($routeName=='api')
           {
              // $search=$request->get('search');
              // $filterBy=$request->get('filter_by');
              // $sortBy=$request->get('sort_by');
              // if($filterBy)
              //    $myBlogs=$myBlogs->where('save_method',$filterBy);
              // if($search)
              //   $myBlogs=$myBlogs->where('title' ,'like','%'.$search.'%');
              // if($sortBy)
              //   $myBlogs=$myBlogs->orderBy('created_at',strtoupper($sortBy));
            
              //   $data['blogList']=$myBlogs->paginate($this->perPage);
              // return ($data);
           }
           else
           {
             
              $data['path']='/profile';
              $initialState=json_encode($data);
              $user=$this->user_state_info();
              return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
           }
    }
}
