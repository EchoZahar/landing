<?php

namespace App\Providers;

use App\Models\Card;
use App\Observers\CardObserver;
use Illuminate\Support\ServiceProvider;

class CardProvider extends ServiceProvider
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
        Card::observe(CardObserver::class);
    }
}
