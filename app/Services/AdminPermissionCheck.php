<?php
namespace App\Services;
use Illuminate\Support\Facades\Route;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repository\ModuleRolePermissionInterface;
use App\Repository\ModuleInterface;
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
     protected $RoleModule;

          /**
     * Object of Module  repository
     *
     * @var Moduleobject
     */
     protected $Module;

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
    public function __construct(ModuleRolePermissionInterface $RoleModule,ModuleInterface $module)
    {
        $this->RoleModule=$RoleModule;
        $this->Module=$module;
    } 
    
    public function checkAdminPermission()
    {
         /**
        * check current Route
        * @return array
        */
        $currentroute=Route::getCurrentRoute()->getAction();
        $currentRouteName=($currentroute['as']);
        $module=$this->Module->getModuleByRouteName($currentRouteName);
        
        $this->User = \Auth::user(); 
        /**
        * check user permission
        * @var Roleid ,Module Id
        * @return mixed
        */
         $permission=$this->RoleModule->userHasPersmissionByRouteName($this->User->role_id,$module->id);
        return $permission;
       
    }
}