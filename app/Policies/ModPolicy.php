<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Blog $blog)
    {
        if ($user->can('blog')) {
            return $user->id == $blog->user_id;
        }
        if ($user->can('auth')) {
            return true;
        }
    }
}
