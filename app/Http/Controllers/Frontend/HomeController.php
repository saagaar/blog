<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Userlogs;
use App\Models\Perm;
use App\Repository\UserlogInterface;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class HomeController extends FrontendController
{
     use HasRoles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    function __construct()
    {
         parent::__construct();
    }

    /**
     * Show the application dashboard.
     *p
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
        $user = Auth()->user()->toArray();
        $data['user']=$user;
        if(\Auth::check())
        return view('frontend.layouts.dashboard');
        else
             return redirect()->route('home'); 
    }

}
