<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repository\UserInterface;
use App\Repository\User\AdminUser;
use App\Repository\HelpCatInterface;
use App\Repository\Helpcat\HelpCat;

use App\Repository\AdminRoleInterface;
use App\Repository\Admin\AdminRole;

use App\Repository\User\Users;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
         $this->app->singleton(UserInterface::class, AdminUser::class);
         $this->app->singleton(HelpCatInterface::class, HelpCat::class);
         $this->app->singleton(AdminRoleInterface::class, AdminRole::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
