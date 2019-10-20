<?php

namespace App\Policies;

use App\Models\Users;

use App\Models\Blogs;

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
    public function update(Users $user, Blogs $blog)
    {

        if ($user->can('edit own posts')) {
            return $user->id != $blog->user_id;
        }
        if ($user->can('edit all posts')) {
            return false;
        }
        if ($user->can('edit posts more then his point')) {
            return false;
        }
    }

}
