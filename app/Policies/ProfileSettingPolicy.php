<?php

namespace App\Policies;

use App\Models\Users;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfileSettingPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
    */
    
    public function updateProfile(Users $user)
    {
        if(Auth()->check())
        {
            return true;
        }
        if ($user->can('edit own profile')) {
            if(request()->segment(2))
                return $user->username ==request()->segment(2);
            else return true;
        }
        if ($user->can('edit all profiles')) {
            return false;
        }
        return false;
        
    }
   
}
