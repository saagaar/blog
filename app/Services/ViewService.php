<?php 

namespace App\Services;

class ViewService 
{
    public function getGeneralCount()
    {
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
    }
}