<?php

use EcoOnline\ContactManagerApi\v1\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| ContactManagerApi API Routes
|--------------------------------------------------------------------------
|
*/

// Routes
Route::group(['prefix' => 'api/contact-manager']->middleware('contact-manager.middleware'), function () {
    Route::get('', [ContactController::class, 'index']);
    Route::put('{contact}', [ContactController::class, 'store']);
    Route::get('{contact}', [ContactController::class, 'show']);
    Route::post('', [ContactController::class, 'update']);
    Route::delete('{contact}', [ContactController::class, 'destroy']);
});
