<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Auth;
use App\Repository\UserInterface; 
use Spatie\Permission\Traits\HasRoles;
class ProfileController extends FrontendController
{
     use HasRoles;

     protected $userAccounts;

     protected $authUser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    function __construct(UserInterface $userInterface)
    {
         parent::__construct();
         $this->userAccounts=$userInterface;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // print_r($this->siteName);
        return view('frontend.layouts.app');
    }

    public function categories()
    {
        if(\Auth::check())
        {
            $user = $this->authUser;
            $data['path']='/categories';
            $initialState=json_encode($data);
            return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);

        }
        else
             return redirect()->route('home'); 
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
