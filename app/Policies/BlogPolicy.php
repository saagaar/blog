<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    /**
     * Determine whether the user can update the Blog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models Blogs $blog
     * @return mixed
     */
    public function update(User $user, Blog $blog)
    {
        if( $user->id == $blog->user_id)
        {
            return true;
        }
    }

}
