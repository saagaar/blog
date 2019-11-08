<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response,File;
use Socialite;
use App\Repository\AccountInterface;

class LoginController extends FrontendController
{
    protected $account;
    public $successStatus = 200;
    public function __construct(AccountInterface $account)
    {
        parent::__construct();
        $this->account=$account;
    }   

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
   
    public function socialLogin($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function dashboard($provider){
    $getInfo = Socialite::driver($provider)->user(); 
    $userData = $this->account->getAll()->where('provider_id', $getInfo->id)->first();
        if (!$userData) {
            $user = $this->registerUser($getInfo,$provider); 
            if($user['status']==true){
                auth()->login($user['userData']); 
            }else{
                return response()->json(['status'=>false,'data'=>'','message'=>$user['message']], 401);
            }
        }else{
            auth()->login($userData); 
        }
        return redirect()->to('/home');
    }
    
    public function registerUser($getInfo,$provider)
    {
        $emailCheck = $this->checkEmailAvailability($getInfo->email);
        if($emailCheck==true){
            $emailParts = explode('@', $getInfo->email);
        $username = $emailParts[0];
        $check = $this->account->getAll()->where('username',$username)->first();
        if (!$check) {
            $infoUsername = $username;
        }else{
            $random = rand(0, 9999);
            $randUsername = $username.$random;
            $infoUsername = $randUsername;
        }
          $userData = $this->account->create([
             'name'     => $getInfo->name,
             'email'    => $getInfo->email,
             'username'     =>$infoUsername,
             'status'        =>'1',
             'provider'     =>$provider,
             'provider_id'  => $getInfo->id,
             'token'        =>$getInfo->token,
         ]);

          return array('status'=>true,'userData'=>$userData,'message'=>'Registered successfully!'); 
        }else{
            return array('status'=>false,'userData'=>'','message'=>'Email Already Exist!'); 
        }
        
    }
    public function login(){
        if(auth()->guard('web')->attempt(['email' => request('email'), 'password' => request('password'),'status'=>1 ]))
        { 
            $user = Auth()->user()->toArray();

         
            return response()->json(['status'=>true,'data'=>$user,'message'=>'Logged in Successfully']); 
        } 
        else
        { 
            return response()->json(['status'=>false,'message'=>'Not able to Login']); 
        } 
    }
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|min:2', 
            'email' => 'required|email|unique:users,email', 
            'password' => 'required|min:6', 
            'repassword' => 'required|min:6|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['status'=>false,'data'=>'','message'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        if($this->userRequiresActivation=='Y'){
            $input['status']    ='1';
        }else{
            $input['status']    ='0';
        }
        $emailParts = explode('@', $input['email']);

        $username = $emailParts[0];
        $check = $this->account->getAll()->where('username',$username)->first();
        if (!$check) {
            $input['username'] = $username;
        }else{
            $random = rand(0, 9999);
            $randUsername = $username.$random;
            $input['username'] = $randUsername;
        }
        $user = $this->account->create($input);
    return response()->json(['status'=>true,'data'=>$user,'message'=>'Registration completed Successfully']); 
    }
    public function isEmailAlreadyRegistered($email){
        $user = $this->account->getAll()->where('email',$email)->first();
        if($user) {
           return response()->json(false); 
            }
        else{
           return response()->json(true); 
        }
           
    } 
    public function checkEmailAvailability($email){
        $user = $this->account->getAll()->where('email',$email)->first();
        if($user) {
           return false; 
            }
        else{
           return true; 
        }
           
    } 
}
