<?php

use EcoOnline\ContactManagerApi\v1\Http\Controllers\ContactController;
use EcoOnline\ContactManagerApi\v1\Http\Middleware\EnsureUserOwnsContact;
use Illuminate\Routing\Middleware\SubstituteBindings;

/*
|--------------------------------------------------------------------------
| ContactManagerApi API Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'prefix' => 'api/contact-manager/v1/',
    'middleware' => ['eco.auth', SubstituteBindings::class, EnsureUserOwnsContact::class]
], function () {
    Route::get('', [ContactController::class, 'index']);
    Route::put('{contact}', [ContactController::class, 'store']);
    Route::get('{contact}', [ContactController::class, 'show']);
    Route::post('', [ContactController::class, 'update']);
    Route::delete('{contact}', [ContactController::class, 'destroy']);
});
