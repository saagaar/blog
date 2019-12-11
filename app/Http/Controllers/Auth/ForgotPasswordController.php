<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Repository\CategoryInterface;
use Session;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    public function showLinkRequestForm(CategoryInterface $category)
    {
          if(auth()->user())
          {
            Session::flash('error', 'You are already logged in !! Please change password from settings!!'); 
            return redirect('/home');
          }
          $navCategory=$category->getCategoryByShowInHome();
          return view('auth.passwords.email')->with('navCategory',$navCategory);
    }
}
