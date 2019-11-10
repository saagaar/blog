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
use Validator;
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
    public function getFollowers(Request $request){
      try{
          $limit=$this->perPage;
          $offset=$request->get('page')*$limit;
          $allFollowers = $this->followerList->getAllFollowers($this->authUser,$limit,$offset);
          return array('status'=>true,'data'=>$allFollowers,'message'=>'');
        
      }
      catch(Exception $e)
      {

          return array('status'=>false,'message'=>$e->getMessage());
      }
    }
    public function getFollowings(Request $request){
      try{
          $limit=$this->perPage;
          $offset=$request->get('page')*$limit;
          $allFollowings = $this->followerList->getAllFollowings($this->authUser,$limit,$offset);
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
    }
    else
    {
      return redirect()->route('home'); 
    }
  }
  public function changeProfile(Request $request)
  {
    if(\Auth::check())
    {
      // $form='';

      if(request()->hasFile('image'))
      {
        $dir = 'images/user-images/';
          if ($this->authUser->image != '' && File::exists($dir . $this->authUser->image)){
            File::delete($dir . $this->authUser->image);
          }
          $imageName = time().'.'.request()->image->getClientOriginalExtension();
          request()->image->move(public_path('/images/user-images/'), $imageName);
          $form['image']=$imageName;
      }
      $this->user->update($this->authUser->id,$form);
      return array('status'=>true,'message'=>'Profile Changed Successfully','data'=>array('imageName'=>$form['image']));
    }else{
      return redirect()->route('home'); 
    }
  }
  public function changeAddress(Request $request)
  {
    if(\Auth::check())
    {
      // $form='';
      $form['address'] = $request->address;
      $form['country'] = $request->country;
      $this->user->update($this->authUser->id,$form);
      return array('status'=>true,'message'=>'Address Changed Successfully','data'=>array('addressName'=>$form['address'],'countryName'=>$form['country']));
    }else{
      return redirect()->route('home'); 
    }
  }
  public function changeBio(Request $request)
  {
    if(\Auth::check())
    {
      // $form='';
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
            return array('status'=>true,'data'=>$data,'message'=>'Success');
          }
          else
          {
              $limit=$this->perPage;
              $data['notifications']=$this->user->getUsersNotification($this->authUser,$limit);
              $data['path']='/users/notifications';
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
  public function settings(Request $request){
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
      // $form='';
      $form[$request->inputName]=$request->inputParams;
      $this->user->update($this->authUser->id,$form);
      $user =$this->user->getUserByUsername($this->authUser->username);
      return array('status'=>true,'message'=>'Changed','data'=>array('me'=>$user));
    }else{
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
      if(Hash::check($request->oldpassword,$this->authUser->password)){
        $validator = Validator::make($request->all(), [ 
            'password' => 'required|min:6', 
            'repassword' => 'required|min:6|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['status'=>false,'data'=>'','message'=>$validator->errors()], 401);            
        }
        $form['password']=Hash::make($request->password);
        $this->user->update($this->authUser->id,$form);
        $user =$this->user->getUserByUsername($this->authUser->username);
        return array('status'=>true,'message'=>'Password Changed','data'=>array('me'=>$user));
      }else{
        return array('status'=>false,'message'=>'old Password incorrect','data'=>'');
      }
      
    }else{
      return redirect()->route('home'); 
    }
  }
}
