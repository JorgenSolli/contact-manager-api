<?php

namespace EcoOnline\ContactManagerApi\Providers;

use Illuminate\Support\Facades\Route;
use EcoOnline\ContactManagerApi\v1\Models\Contact;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        Route::model('contact', Contact::class);
    }
}
