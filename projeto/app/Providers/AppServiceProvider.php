<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\LocationsDbService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('Locations', function () {
            return new LocationsDbService();
        });
    }
}
