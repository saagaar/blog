<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserInterface;
use Auth;
use Session;
class AdminController extends Controller
{
    
    protected $admin;
    protected $data;
    protected $user;

    function __construct(UserInterface $admin)
    {
        $this->admin=$admin;
        
        $this->middleware('auth:admin')->except('logout');
       
    }
    public function dashboard()
    {
     
        $this->user = auth()->user();
       
        $data=$this->admin->getById($this->user->id);
        // dd($data->username);
        // $data=($this->user->getAll());
        // dd($data->username);
        return view('admin.dashboard',compact('data'));
    }
    
    
    
}
