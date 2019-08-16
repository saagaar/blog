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
use App\Repository\CategoryInterface;
use App\Repository\category\Category;
use App\Repository\SiteoptionsInterface;
use App\Repository\Siteoptions\SiteOption;
use App\Repository\BlogInterface;
use App\Repository\blog\Blog;
use App\Repository\LocaleInterface;
use App\Repository\locale\Locale;
use Illuminate\Support\ServiceProvider;
use App\Repository\AccountInterface;
use App\Repository\Account\Accounts;
use App\Repository\RoleInterface;
use App\Repository\Role\Roles;
use App\Repository\PermissionInterface;
use App\Repository\Userpermission\Permissions;
use App\Repository\CmsInterface;
use App\Repository\Cms\Cmss;
use App\Repository\TestimonialInterface;
use App\Repository\Testimonial\Testimonial;
use App\Repository\ServiceInterface;
use App\Repository\Service\Service;
use App\Repository\TeamInterface;
use App\Repository\Team\Team;
use App\Repository\ClientInterface;
use App\Repository\Client\Client;
use App\Repository\BannerInterface;
use App\Repository\Banner\Banner;

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
        $this->app->singleton(UserInterface::class, AdminUser::class,User::class);
        $this->app->singleton(HelpcatInterface::class, HelpCat::class);
        $this->app->singleton(ModuleInterface::class, Module::class);
        $this->app->singleton(AdminRoleInterface::class, AdminRole::class);
        $this->app->singleton(ModuleRolePermissionInterface::class, ModuleRolePermission::class);
        $this->app->singleton(CategoryInterface::class, Category::class);
        $this->app->singleton(SiteoptionsInterface::class, SiteOption::class);
        $this->app->singleton(BlogInterface::class, Blog::class);
        $this->app->singleton(LocaleInterface::class, Locale::class);
        $this->app->singleton(AccountInterface::class, Accounts::class);
        $this->app->singleton(RoleInterface::class, Roles::class);
        $this->app->singleton(PermissionInterface::class, Permissions::class);
        $this->app->singleton(CmsInterface::class, Cmss::class);
        $this->app->singleton(TestimonialInterface::class, Testimonial::class);
        $this->app->singleton(ServiceInterface::class, Service::class);
        $this->app->singleton(TeamInterface::class, Team::class);
        $this->app->singleton(ClientInterface::class, Client::class);
        $this->app->singleton(BannerInterface::class, Banner::class);
    }
}
