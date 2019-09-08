<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

 use Validator,Redirect,Response,File;
use Socialite;
use App\Repository\AccountInterface;

class LoginController extends BaseController
{
    protected $account;
    public function __construct(AccountInterface $account)
    {
        $this->account=$account;
    }   

    /**
     * Show the application dashboard.
     *p
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

   

        // print_r($request->server('HTTP_USER_AGENT'));
        return view('frontend.home.index');
    }
    public function socialLogin($provider)
    {
        return Socialite::driver($provider)->redirect();

    }
    public function dashboard($provider){
    $getInfo = Socialite::driver($provider)->user(); 
    // dd($getInfo);
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
}
