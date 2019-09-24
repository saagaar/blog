<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Repository\BlogInterface; 
use App\Repository\AccountInterface; 
use App\Repository\FollowerInterface; 
use App\Models\Perm;
use Spatie\Permission\Traits\HasRoles;
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
   
    function __construct(FollowerInterface $followInterface,AccountInterface $accountInterface)
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

            $suggestion=$this->getFollowSuggestions(3);
            $user =$this->authUser;
            $user->followersCount=100;
            $user->followingCount=10;
            $user=$user->toArray();
            $data['followSuggestion']=$suggestion;
            $data['path']='/blog/list';
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
