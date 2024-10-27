<?php

namespace App\Providers;

use App\Models\Car;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Car::observe(\App\Observers\CarObserver::class);
    }
}
