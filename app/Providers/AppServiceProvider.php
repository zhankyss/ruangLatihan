<?php

namespace App\Providers;

use App\Services\PrayerService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use PrayerTimeService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PrayerTimeService::class, function($app){
            return new PrayerTimeService(new \GuzzleHttp\Client());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
