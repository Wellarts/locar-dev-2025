<?php

namespace App\Providers;

use App\Services\AssinafyService;
use Illuminate\Support\ServiceProvider;

class AssinafyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AssinafyService::class, function ($app) {
            return new AssinafyService(
                config('services.assinafy.account_id'),
                config('services.assinafy.api_token'),
                config('services.assinafy.base_uri')
            );
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