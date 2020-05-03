<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
// use App\Channels\DatabaseChannel;
// use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;

// use App\Http\Middleware\CheckUserPermission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(CheckUserPermission::class, AdminUser::class);
        $this->app->singleton(CheckUserPermission::class, function(Application $app) {
        return new CheckUserPermission(
                $app->make(AdminPermissionCheck::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // $this->app->instance(IlluminateDatabaseChannel::class, new DatabaseChannel);
    }
}
