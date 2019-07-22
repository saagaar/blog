<?php

namespace App\Providers;
use App\Repository\UserInterface;
use App\Repository\User\AdminUser;
use App\Repository\HelpCatInterface;
use App\Repository\Helpcat\HelpCat;
use App\Repository\AdminRoleInterface;
use App\Repository\Admin\AdminRole;
use App\Repository\ModuleRolePermissionInterface;
use App\Repository\ModuleRole\ModuleRolePermission;
use App\Repository\ModuleInterface;
use App\Repository\Module\Module;
use App\Repository\BlogcategoriesInterface;
use App\Repository\Blogcategories\Blogcategories;
use App\Repository\SiteoptionsInterface;
use App\Repository\Siteoptions\SiteOption;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserInterface::class, AdminUser::class);
        $this->app->singleton(HelpcatInterface::class, HelpCat::class);
        $this->app->singleton(ModuleInterface::class, Module::class);
        $this->app->singleton(AdminRoleInterface::class, AdminRole::class);
        $this->app->singleton(ModuleRolePermissionInterface::class, ModuleRolePermission::class);
        $this->app->singleton(BlogcategoriesInterface::class, Blogcategories::class);
        $this->app->singleton(SiteoptionsInterface::class, SiteOption::class);

    }
}
