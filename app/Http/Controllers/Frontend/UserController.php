<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
use App\Repository\AccountInterface; 

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
    public function myBlogs()
    {
   

        // $user=$this->user_state_info();
        // if($user)
        // {
        $user='';
           
            $myBlogs=$this->user->getBlogsByUser($this->authUser->username);
            $data['blogList']=$myBlogs;
            $data['path']='blog/list';
            return $data;
            // $initialState=json_encode($data);
            // return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);

        // }
        // else
        //      return redirect()->route('home'); 
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
            $this->followerList->unfollowUser($this->authUser,$username);
         }  
        return array('status'=>true,'message'=>'');
    }
    public function getFollowSuggestions($limit=1,$offset=0)
    {
     
       return $this->followerList->getFollowUserSuggestions($this->authUser,$limit,$offset);
    }
}
