<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Pizza;
use App\Observers\PizzaObserver;

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
        Pizza::observe(PizzaObserver::class); 
    }
}
