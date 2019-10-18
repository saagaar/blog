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
    public function UpdateBlog(Users $user, Blogs $blog)
    {

        if ($user->can('edit own posts')) {
            return $user->id == $post->user_id;
        }
        if ($user->can('edit all posts')) {
            return true;
        }
    }

}
