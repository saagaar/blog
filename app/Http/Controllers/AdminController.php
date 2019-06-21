<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repository\UserInterface;
use Auth;
use Session;
class AdminController extends Controller
{
    
    protected $user;
    protected $admin;

     function __construct(UserInterface $admin)
    {
        $this->admin=$admin;
        $this->middleware('auth:admin')->except('logout');
    }

    public function dashboard()
    {

        $data=$this->admin->getAll();
        print_r($data->username);
        // $data=($this->user->getAll());
        // dd($data->username);
        return view('admin.dashboard');
    }
    
    
}
