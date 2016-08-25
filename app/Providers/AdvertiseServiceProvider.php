<?php

namespace Nht\Providers;

use Illuminate\Support\ServiceProvider;

class AdvertiseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Nht\Hocs\Advertise\AdsRepository', 
            'Nht\Hocs\Advertise\DbAdsRepository');
    }
}
