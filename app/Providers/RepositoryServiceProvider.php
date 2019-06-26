<?php

namespace App\Providers;
use App\Repository\UserInterface;
use App\Repository\User\AdminUser;
use App\Repository\HelpCatInterface;
use App\Repository\Helpcat\HelpCat;
use App\Repository\AdminRoleInterface;
use App\Repository\Admin\AdminRole;
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
        $this->app->singleton(AdminRoleInterface::class, AdminRole::class);

    }
}
