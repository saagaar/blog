<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Services\NotificationCommander;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repository\ModuleRolePermissionInterface;
use Illuminate\Support\Facades\Route;

use Auth;
use Session;
class AdminController extends BaseController
{
     use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $admin;
   
    protected $RolePermission;
     
     /**
    *User object Global
    *@var obj
    */
    protected $User;
    /**
    *Page limit Global
    *@var int
    */
    protected $PerPage=10;

    public function __construct(ModuleRolePermissionInterface $RolePermission)
    {
        $this->middleware('auth:admin')->except('logout');
        $this->middleware('check_user_permission');
        $this->RolePermission=$RolePermission;
        
    }
    public function dashboard()
    {
        // print_r(Auth::user()->id);exit;
       
        $routes= Route::getRoutes()->getByName('admin.dashboard');
             // print_r($routes->getAction()['prefix']);exit;
       $controllers = [];

        foreach (Route::getRoutes()->getRoutes() as $route)
        {
            $actions=$route->getAction();
            $actionprefix =$actions['prefix'];

            if ($actionprefix=='/admin')
            {
                // You can also use explode('@', $action['controller']); here
                // to separate the class name from the method
                $controllers[] = $actions;
            }
        }
    
      
        // $role=$rolepermission->getModuleByRoleId($this->User->role_id);
        // print_r($this->User);exit;
        // print_r($this->user);
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
