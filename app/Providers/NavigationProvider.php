<?php

namespace App\Providers;

use App\Models\Navigation;
use App\Observers\NavigationObserver;
use Illuminate\Support\ServiceProvider;

class NavigationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Navigation::observe(NavigationObserver::class);
    }
}
