<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
use App\Repository\AccountInterface; 
use App\Repository\BlogInterface; 
use Illuminate\Support\Facades\File;
use App\Repository\FollowerInterface; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notifications\Notifications;
use Validator;
class UserController extends FrontendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    use AuthorizesRequests;
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

    public function profile(BlogInterface $blog,Request $request,$username=false)
    { 
       $routeName= Route::currentRouteName();
       $user=$this->user_state_info($username);
       if(!$user)
          return redirect()->route('home')
                        ->with('error','No user found!!'); 
       $myBlogs=$blog->getActiveBlogByUserId($user['userid']);
       unset($user['userid']);
       if($routeName=='api')
       {
          $search=$request->get('search');
          if($search)
                $myBlogs=$myBlogs->where('title' ,'like','%'.$search.'%');
          $sortBy=$request->get('sort_by');
          if($sortBy)
            $myBlogs=$myBlogs->orderBy('created_at',strtoupper($sortBy));
          $data['blogList']=$myBlogs->paginate($this->perPage);
          return ($data);
       }
       else
       {
          $data['blogList']=$myBlogs->paginate($this->perPage);
          $data['path']='/profile/'.$username;
          $initialState=json_encode($data);
          return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
       }
    }

    public function followings($username=false)
    {
        $authFollowing=[];
         if($username)
         {
            $userdata=$this->user->getUserByUsername($username);
         }
         else
         {
            $userdata=$this->authUser;
            $authFollowing = $this->followerList->getAllFollowings($this->authUser)->pluck('username');
         }
        if(!$userdata){
          if($routeName=='api')
            return array('status'=>false,'message'=>'No user found!!');
          else
          return redirect()->route('home')
                        ->with('error','No user found!!');     
        }
        $routeName= ROUTE::currentRouteName();
        $suggestion=$this->getFollowSuggestions($userdata,3);
        $followings = $this->followerList->getAllFollowings($userdata);
        
        $data['followSuggestion']=$suggestion;
        $data['followings'] = $followings;
        $data['authFollowing'] = $authFollowing;
        if($routeName=='api')
        {
            return ($data);
        }
        else
        {
            $data['path']='/followings';
            $initialState=json_encode($data);
            $user=$this->user_state_info($username);
            return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
        }
    }
    public function followers($username=false)
    {
        $followings = [];
        if($username){
            $userdata=$this->user->getUserByUsername($username);
        }
        else{
            $userdata=$this->authUser;
            $followings = $this->followerList->getAllFollowings($this->authUser)->pluck('username');
        }
        $data['userdata'] = $userdata;
        if(!$userdata )
        {
          if($routeName=='api')
            return array('status'=>false,'message'=>'No user found!!');
          else
          return redirect()->route('home')
                        ->with('error','No user found!!');        
        }
        $routeName= ROUTE::currentRouteName();
        $followers = $this->followerList->getAllFollowers($userdata);
        
        $data['followers'] = $followers;
        $data['followings'] = $followings;
        if($routeName=='api')
        {
          return ($data);
        }
        else
        {
            $data['path']='/followers';
            $initialState=json_encode($data);
            $user=$this->user_state_info($username);
            return view('frontend.layouts.dashboard',['initialState'=>$data,'user'=>$user]);
        }
    }
    public function getFollowers($user=false,Request $request){
      try{
          if($user)
          {
            $userdata=$this->user->getUserByUsername($user);
          }
          else{
            $userdata=$this->authUser;
          }
          if(!$userdata)
           throw new Exception("No User Found!!", 1);
          $limit=10;

          $offset=$request->get('page')*$limit;
          // print_r($offset);exit;
          $allFollowers = $this->followerList->getAllFollowers($userdata,$limit,$offset);
          return array('status'=>true,'data'=>$allFollowers,'message'=>'');
      }
      catch(Exception $e){
          return array('status'=>false,'message'=>$e->getMessage());
      }
    }
    public function getFollowings($user=false,Request $request){
      try
      {
           if($user)
            {
              $userdata=$this->user->getUserByUsername($user);
            }
            else{
              $userdata=$this->authUser;
            }
          if(!$userdata)
           throw new Exception("No User Found!!", 1);
          $limit=10;
          $offset=$request->get('page')*$limit;
          $allFollowings = $this->followerList->getAllFollowings($userdata,$limit,$offset);
          return array('status'=>true,'data'=>$allFollowings,'message'=>'');
          
      }
      catch(Exception $e)
      {

          return array('status'=>false,'message'=>$e->getMessage());
      }
    }
    public function followUser($username,$offset=false)
    {
        $isFollowing=$this->followerList->isFollowingByUsername($this->authUser,$username);
         if(!($isFollowing))
         {
            $this->followerList->followUser($this->authUser,$username);
         }  
        $code='follow_notification';
        $userdata=$this->user->getUserByUsername($username);
        $data=['NAME'=>$this->authUser->name,'URL'=>url('/followers/'.$this->authUser->username)];
        $userdata->notify(new Notifications($code,$data));
         return array('status'=>true,'message'=>$this->getFollowSuggestions($this->authUser,1,$offset));
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
    public function getFollowSuggestions($user,$limit=1,$offset=0)
    {
       return $this->followerList->getFollowUserSuggestions($user,$limit,$offset);
    }
    public function changeProfile(Request $request)
    {
        if(\Auth::check())
        {
          $this->authorize('updateProfile', $this->authUser);
          $allowedFileExtension=['jpg','png','jpeg','gif','svg'];
          if(request()->hasFile('image'))
          {
            $dir = '/uploads/user-images/';
            if (!File::isDirectory(public_path().$dir)) {
                File::makeDirectory(public_path().'/'.$dir,0777,true,true);
            }
            if ($this->authUser->image != '' && File::exists($dir . $this->authUser->image)){
              File::delete($dir . $this->authUser->image);
            }
             $extension = request()->image->getClientOriginalExtension();
              $check=in_array($extension,$allowedFileExtension);
              if($check)
                {
                  $imageName = time().'.'.request()->image->getClientOriginalExtension();
                  request()->image->move('uploads/user-images/', $imageName);
                  $form['image']=$imageName;
                   $this->user->update($this->authUser->id,$form);
                  return array('status'=>true,'message'=>'Profile Changed Successfully','data'=>array('imageName'=>$form['image']));
                }else 
                  {
                    return  array('status'=>false,'message'=>'File must be jpg, png, jpeg, gif, svg ','data'=>array());
                  }
          }
          else
          {
              return  array('status'=>false,'message'=>'Profile Image unable to Update','data'=>array());
          }
        }
        else
        {
              return redirect()->route('home'); 
        }
    }
  public function changeAddress(Request $request)
  {
    $this->authorize('updateProfile', $this->authUser);
    if(\Auth::check())
    {
      $form['address'] = $request->address;
      $form['country'] = $request->country;
      $this->user->update($this->authUser->id,$form);
      return array('status'=>true,'message'=>'Address Changed Successfully','data'=>array('addressName'=>$form['address'],'countryName'=>$form['country']));
    }
    else
    {
      return redirect()->route('home'); 
    }
  }
  public function changeBio(Request $request)
  {
    
    if(\Auth::check())
    {
      $this->authorize('updateProfile', $this->authUser);
      $form['bio'] = $request->bio;
      $this->user->update($this->authUser->id,$form);
      return array('status'=>true,'message'=>'Bio Updated Successfully','data'=>array('bioName'=>$form['bio']));
    }else{
      return redirect()->route('home'); 
    }
  }
  public function notifications(Request $request)
  {
    if(\Auth::check())
        {
           $routeName= ROUTE::currentRouteName();
           $data=array();
          if($routeName=='api')
          {
            $limit=$this->apiPerPage;;
            $offset=$limit*$request->post('page');
            $data['notifications']=$this->user->getUsersNotification($this->authUser,$limit,$offset);
           
            $this->user->markNotificationsToRead($data['notifications']);
            $data['unReadNotificationsCount']=$this->user->countUnreadNotifications($this->authUser) ;
            return array('status'=>true,'data'=>$data,'message'=>'Success');
          }
          else
          {
              $limit=$this->perPage;
              $data['notifications']=$this->user->getUsersNotification($this->authUser,$limit);
              $this->user->markNotificationsToRead($data['notifications']);
              $data['path']='/users/notifications';
              $initialState=json_encode($data);
              $user=$this->user_state_info();
              return view('frontend.layouts.dashboard',['initialState'=>$initialState,'user'=>$user]);
          }
        }
        else 
        {
             return redirect()->route('home'); 
        }
  }
  public function updateNotificationStatus(){
   if(\Auth::check())
    {
        $data=array();
        $notifications=$this->user->getUsersNotification($this->authUser,$this->apiPerPage);
        $this->user->markNotificationsToRead($notifications);

        $data['unReadNotificationsCount']=$this->user->countUnreadNotifications($this->authUser) ;
        return  array('status'=>true,'data'=>$data,'message'=>'Success');
    }
   else
    {
       return  array('status'=>false,'message'=>'User not logged in!!');
    }
  }
  public function settings(Request $request)
  {
    $this->authorize('updateProfile', $this->authUser);
    if(\Auth::check())
    {
            $routeName= Route::currentRouteName();
            $data['path']='/profile';
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
  public function changeDetails(Request $request)
  {
    if(\Auth::check())
    {
      if($request->inputName=='dob'){
        $form['dob']=date('Y-m-d',strtotime($request->inputParams));
      }
      else{
        $form[$request->inputName]=$request->inputParams;
      }
      $this->user->update($this->authUser->id,$form);
      $user =$this->user->getUserByUsername($this->authUser->username);
      return array('status'=>true,'message'=>'Changed','data'=>array('me'=>$user));
    }
    else{
      return redirect()->route('home'); 
    }
  }
  public function emailAvailabilityForUpdate($email){
      $user = $this->user->getAll()->where('email',$email)->first();
      if($user) {
          if($this->authUser->email==$email){
              return response()->json(true); 
          }else
               return response()->json(false); 
      }
      else{
         return response()->json(true); 
      }
  } 
  public function changePassword(Request $request)
  {
    if(\Auth::check())
    {
      if(Hash::check($request->oldpassword,$this->authUser->password))
      {
        $validator = Validator::make($request->all(), [ 
            'password' => 'required|min:6', 
            'repassword' => 'required|min:6|same:password', 
        ]);
        if ($validator->fails()) 
        { 
            return response()->json(['status'=>false,'data'=>'','message'=>$validator->errors()], 401);            
        }
        $form['password']=Hash::make($request->password);
        $this->user->update($this->authUser->id,$form);
        $user =$this->user->getUserByUsername($this->authUser->username);
        return array('status'=>true,'message'=>'Password Changed','data'=>array('me'=>$user));
      }
      else
      {
        return array('status'=>false,'message'=>'old Password incorrect','data'=>'');
      }
      
    }
    else{
      return redirect()->route('home'); 
    }
  }
}
