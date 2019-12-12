<?php

namespace App\Providers;
use Laravel\Passport\Passport; 
use Illuminate\Support\Facades\Gate;
use App\Models\Users;
use App\Policies\BlogPolicy;
use App\Policies\ProfileSettingPolicy;

use App\Models\Blogs;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
         Users::class =>ModPolicy::class,
         Users::class => BlogPolicy::class,
         Blogs::class => BlogPolicy::class,
         Users::class => ProfileSettingPolicy::class
    ];
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes(); 
    }
}
