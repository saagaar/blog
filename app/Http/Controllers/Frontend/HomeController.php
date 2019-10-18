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
        return view('frontend.layouts.app');
    }

    public function test(Request $request)
    {
        $code='user_registration';
        $data=['USERNAME'=>$this->authUser->name,'SITENAME'=>$this->siteName];
        // print_r($data);exit;
        $this->authUser->notify(new Notifications($code,$data));

            // foreach ($this->authUser->unreadNotifications as $notification) {
            //      echo $notification->data['message'];
            // }
            // exit;
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
