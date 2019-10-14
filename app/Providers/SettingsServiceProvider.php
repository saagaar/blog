<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\SiteoptionInterface; 

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(\Illuminate\Contracts\Cache\Factory $cache, SiteoptionInterface $settings)
    {
        // $siteOptions=$settings->getSiteInfo()->toArray();
        // $settings = $cache->remember('settings', 60, function() use ($siteOptions )
        // {
        //   return $siteOptions; 
        // });
        // config()->set('settings', $settings);
    }
}
