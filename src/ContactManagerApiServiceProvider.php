<?php

namespace EcoOnline\ContactManagerApi;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ContactManagerApiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router): void
    {
        // Middleware
        $router->aliasMiddleware('contact-manager.middleware', \EcoOnline\ContactManagerApi\v1\Http\Middleware\Middleware::class);

        // Load the API routes if enabled
        if (config('contact-manager.enable_api_routes')) {
            $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        }

        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
