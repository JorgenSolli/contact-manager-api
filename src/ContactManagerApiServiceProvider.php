<?php

namespace EcoOnline\ContactManagerApi;

use Illuminate\Support\ServiceProvider;
use EcoOnline\ContactManagerApi\v1\Models\User;
use EcoOnline\ContactManagerApi\v1\Observers\UserObserver;
use EcoOnline\ContactManagerApi\Providers\AuthServiceProvider;
use EcoOnline\ContactManagerApi\Providers\RouteServiceProvider;

class ContactManagerApiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Observers
        User::observe(UserObserver::class);

        // Load the API routes if enabled
        if (config('contact-manager.enable_api_routes')) {
            $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        }

        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);

        // Configuration
        $this->mergeConfigFrom(__DIR__ . '/config/contact-manager.php', 'contact-manager');
    }
}
