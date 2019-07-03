<?php
namespace App\Services;
use Illuminate\Support\Facades\Route;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repository\ModuleRolePermissionInterface;
// use App\Repository\User\AdminUser;
use Illuminate\Support\Facades\Auth;


/**
 * Class AdminPermissionCheck
 * @package App\Services
 */
class AdminPermissionCheck
{
    // use AuthorizesRequests;
     /**
     * Object of admin user repository
     *
     * @var ModuleRolePermission object
     */
     protected $RoleModule;


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
    public function __construct(ModuleRolePermissionInterface $RoleModule)
    {

        $this->RoleModule=$RoleModule;
    }
    
    public function check()
    {
        // print_r(Route::getRoutes());exit;
        $this->User = \Auth::user();         
        // print_r ($this->RoleModule->getModuleByRoleId($this->User->role_id));exit;
    }
}