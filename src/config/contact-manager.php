<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | This allows you to disable or enable the API routes. This might be 
    | needed in certain environments, thus saving you the troubble from 
    | having to remove the package from Composer.
    |
    */

    'enable_api_routes' => env('CONTACT_MANAGER_ENABLE_API_ROUTES', false),
];
