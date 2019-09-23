<?php
namespace App\Services;
use Illuminate\Support\Facades\Route;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repository\AdminRolePermissionInterface;
use App\Repository\AdminPermissionInterface;
// use App\Repository\User\AdminUser;
use Illuminate\Support\Facades\Auth;

/**
 * Class AdminPermissionCheck
 * @package App\Services
 */
class AdminPermissionCheck
{
    
     /**
     * Object of Role  repository
     *
     * @var ModuleRolePermission object
     */
     protected $roleAdmin;

          /**
     * Object of Module  repository
     *
     * @var Moduleobject
     */
     protected $permission;

      /**
     * Object of ModuleRolePermission repository
     *
     * @var RoleModule object
     */
     // protected $RoleModule;

    /**
     * @param User $user
     * @param AdminRole $role
     * @return bool
     */
    public function __construct()
    {
        $this->roleAdmin = app()->make('App\Repository\AdminRolePermissionInterface');
        $this->permission=app()->make('App\Repository\AdminPermissionInterface');
    } 
    
    public function checkAdminPermission()
    {
         /**
        * check current Route
        * @return array
        */
        $currentroute=Route::getCurrentRoute()->getAction();
        $currentRouteName=($currentroute['as']);
        $permission=$this->permission->getModuleByRouteName($currentRouteName);
        $this->User = \Auth::user(); 
        /**
        * check user permission
        * @var Roleid ,Module Id
        * @return mixed
        */
        if(!blank($permission))
        {
             $permission=$this->roleAdmin->userHasPersmissionByRouteName($this->User->role_id,$module->id);
             return $permission;
        }
        return false;
        
       
    }
}