<?php

namespace App\Providers;

use App\Contracts\ImageStorageInterface;
use App\Services\LocalImageStorageService;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind the ImageStorageInterface to the LocalImageStorageService implementation
        $this->app->bind(ImageStorageInterface::class, LocalImageStorageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
