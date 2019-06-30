<?php
namespace App\Services;

use App\Repository\Admin\AdminRole;
use App\Repository\User\AdminUser;


/**
 * Class AdminPermissionCheck
 * @package App\Services
 */
class AdminPermissionCheck
{
     /**
     * Object of admin user repository
     *
     * @var AdminUser object
     */
     protected $adminuser;


      /**
     * Object of Role repository
     *
     * @var AdminUser object
     */
     protected $adminrole;

    /**
     * @param User $user
     * @param AdminRole $role
     * @return bool
     */
    public function __construct()
    public function check(AdminUser $user,  AdminRole $role)
    {
        // Admin has everything
        if ($user->hasRole(UserRole::ROLE_ADMIN)) {
            return true;
        }
        else if($user->hasRole(UserRole::ROLE_MANAGEMENT)) {
            $managementRoles = UserRole::getAllowedRoles(UserRole::ROLE_MANAGEMENT);

            if (in_array($role, $managementRoles)) {
                return true;
            }
        }

        return $user->hasRole($role);
    }
}