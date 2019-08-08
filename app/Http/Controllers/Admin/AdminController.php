<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repository\UserInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Services\NotificationCommander;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Route;
use App\Repository\ModuleInterface;

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

    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
        $this->middleware('check_user_permission')->except('logout');
    }
    public function dashboard()
    {
        $breadcrumb=[   'breadcrumbs' => 
                    [
                        'current_menu' => 'Dashboard',
                    ]];
        return view('admin.dashboard',compact('breadcrumb'));
    }
    
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return (redirect()->route('admin.login'));
    }

    public function ImportModules(ModuleInterface $module)
    {
        $controllers = [];
        $i=1;
        foreach (Route::getRoutes()->getRoutes() as $route)
        {
            $actions=$route->getAction();
            $actionprefix =$actions['prefix'];

            if ($actionprefix=='/admin')
            {
                $url=$actions['controller'];
                $parseurl=explode('@',$url);
                $precontroller= str_replace($actions['namespace'], '', $actions['controller']);
                $postcontroller=explode('@',$precontroller);
                $finalcontroller=trim(trim($postcontroller['0'],'\\'));
                $method=$parseurl['1'];
                $controllers['namespace']= $actions['namespace'];
                $controllers['name']= str_replace('Controller','',$finalcontroller);
                $controllers['controller']=$finalcontroller;
                $controllers['full_path']=$actions['controller'];
                $controllers['route_name']=$actions['as'];
                $controllers['method']=$method;
                $controllers['display_order']=$i;
                $modules[]=$controllers;

                $i++;
            }
        }
        $module->deleteAll();
        $module->create($modules);
        echo 'Import Successfull';

    }
  
}