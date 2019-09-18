<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response,File;
use Socialite;
use App\Repository\AccountInterface;

class LoginController extends BaseController
{
    protected $account;
    public $successStatus = 200;
    public function __construct(AccountInterface $account)
    {
        // parent::__construct();
        $this->account=$account;
    }   

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('frontend.home.index');
    }
    public function socialLogin($provider)
    {
        return Socialite::driver($provider)->redirect();

    }
    public function dashboard($provider){
    $getInfo = Socialite::driver($provider)->user(); 
    $userdata = $this->account->getAll()->where('provider_id', $getInfo->id)->first();
        if (!$userdata) {
        $user = $this->createuser($getInfo,$provider); 
        }
        auth()->login($user); 
        return redirect()->to('/home');
    }
    
    public function createuser($getInfo,$provider)
    {
          $userdata = $this->account->create([
             'name'     => $getInfo->name,
             'email'    => $getInfo->email,
             'status'        =>'0',
             'provider'     =>$provider,
             'provider_id'  => $getInfo->id,
             'image'        =>$getInfo->avatar_original,
             'token'        =>$getInfo->token,
         ]);
        return $userdata;
    }
    public function login(){  
        if(Auth::guard('web')->attempt(['email' => request('email'), 'password' => request('password')]))
        { 
            $userid = Auth()->user()->id;
            $user = $this->account->getById($userid);
            // $success['token'] =  $user->createToken('MyApp')->accessToken; 
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
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'confirm_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['status'=>false,'error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = $this->account->create($input); 
        // $success['token'] =  $user->createToken('MyApp')->accessToken; 
        $success['name'] =  $user->name;
    return response()->json(['status'=>true,'data'=>$user,'message'=>'Registration completed Successfully']); 
    }
    public function user(){
        $userid = Auth()->user()->id;
        $user = $this->account->getById($userid);
         return response()->json(['success' => $user], $this->successStatus); 
    }  
}
