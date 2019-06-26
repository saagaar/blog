<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Services\NotificationCommander;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Auth;
use Session;
class AdminController extends BaseController
{
     use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $admin;
    protected $data;
    protected $user;

    /**
    *Page limit Global
    *@var int
    */
    protected $PerPage=10;

    function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }
    public function dashboard()
    {
        // $this->user = auth()->user();
       
        // $data=$this->admin->getById($this->user->id);
        // dd($data->username);

        // $data=($this->user->getAll());
        // dd($data->username);
        return view('admin.dashboard',compact('data'));
    }
    
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return (redirect()->route('admin.login'));
    }
  
}
