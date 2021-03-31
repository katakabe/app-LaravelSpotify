<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SpotifyService;

class CustomSpotifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SpotifyService::class, SpotifyService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
