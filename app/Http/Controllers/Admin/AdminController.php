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
use App\Repository\AdminPermissionInterface;
use App\Repository\VisitorLogInterface;
use App\Repository\AccountInterface;
use App\Repository\BlogInterface;
use Auth;
use Session;
class AdminController extends BaseController
{
     use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $admin;

    protected $RolePermission;
    protected $visitor;
     protected $user;
     protected $blog;


     /**
    *User object Global
    *@var obj
    */
    protected $User;
    /**
    *Page limit Global
    *@var int
    */
    protected $PerPage=20;

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('check_user_permission');
    }

    public function dashboard(VisitorLogInterface $visitor, AccountInterface $user,BlogInterface $blog)
    {
       
        $breadcrumb=[
                        'breadcrumbs' => [
                        'current_menu' => 'Dashboard',                       
                    ]];
        $dashboard=array(); 
        $dashboard['allLoggedInVisitors']=$visitor->countTodayLoggedInVisitors();
        $dashboard['allVisitors']=$visitor->countAllVisitors();
        $allvisitorsbyCountry=$visitor->getCountryCodeOfVisitors()->toArray();
        $collection=collect($allvisitorsbyCountry);
        $plucked = $collection->pluck('count', 'country_code');
        $dashboard['allvisitorsbyCountry']=collect($plucked->all())->toJson();
        $dashboard['allRegisteredVisitors']=$visitor->countTodaysPageVisitors();             
        $dashboard['allRegisteredUsers']=$user->countAllUsers();
        $dashboard['allUsers']=$user->countAllUsers();    
        $dashboard['loggedinUsers']=$user->countAllTodayLoggedInUsers();
        $dashboard['activeUsers']=$user->countActiveUsers();
        $dashboard['inActiveUsers']=$user->countInActiveUsers();   

        $dashboard['allBlogUsers']=$blog->countAllBlogUser();
        $dashboard['publishedBlogs']=$blog->countPublishedBlog();
        $dashboard['savedBlogs']=$blog->countSavedBlog();
        $dashboard['todayPublishedBlogs']=$blog->countTodaysPublishedBlogs();
        $dashboard['publishedBlogsThisMonth']=$blog->countPublishedBlogsThisMonth();
                          
        return view('admin.dashboard-report',compact('breadcrumb','dashboard'))->with(array('primary_menu'=>'dashboard.list'));
    } 
   
   
    public function ImportModules()
    {
        $module = app()->make('App\Repository\AdminPermissionInterface');
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
                $controllers['route_name']=isset($actions['as'])?$actions['as']:'';
                $controllers['method']=isset($method)?$method:'';;
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
