<?php 

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('adminMenuLabels', function ($expression) {
           $account = app()->make('App\Repository\AccountInterface');
            $registeredUserCount=$account->countAllUsers();
            $blogs = app()->make('App\Repository\BlogInterface');
            $publishedBlogscount=$blogs->countPublishedBlog();
            $tags = app()->make('App\Repository\TagInterface');
            $tagscount=$tags->countActiveTags();
            $roles = app()->make('App\Repository\RoleInterface');
            $rolesCount=$roles->countAllRoles();
            return [
                        'totalUserCount'       => $registeredUserCount,
                        'publishedBlogCount'   => $publishedBlogscount,
                        'activeTagsCount'      => $tagscount,
                        'activeRolesCount'     => $rolesCount
                   ];
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}