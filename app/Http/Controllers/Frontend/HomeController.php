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

class HomeController extends FrontendController
{
     use HasRoles;

     protected $followerList;

     protected $userAccounts;

     protected $authUser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    function __construct(FollowerInterface $followInterface)
    {
         parent::__construct();
         $this->followerList=$followInterface;
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

    public function test(Request $request)
    {


         Mail::to('abhishekgiri49.ag@gmail.com')->send(new SendMailable());
        // echo str_slug("iajaf1237412~!@#$%^&*()~'-'=+_][{} ;:/.,<>?AAMNBV'' CXZLKJHG",'-');

        return view('frontend.layouts.app');
    }
    public function dashboard()
    {

        //     $role = Role::findByName('writer');
        // $role->givePermissionTo('blog-edit');
        // $permissions = [
          // \Auth::user()->givePermissionTo('blog-create');
        //    'blog-edit',
        //    'blog-create',
        //    'product-delete'
        // ];


        // foreach ($permissions as $permission) {
        //      Permission::create(['name' => $permission]);
        // }
        
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
