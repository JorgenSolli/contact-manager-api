<?php

namespace EcoOnline\ContactManagerApi\v1\Http\Middleware;

use App;
use Closure;
use Illuminate\Support\Facades\Log;

/**
 * Class Middleware
 *
 * @package EcoOnline\ContactManagerApi
 */
class Middleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        if (App::environment('local')) {
            Log::debug('[EcoPackage Middleware] Hello world');
        }

        return $next($request);
    }
}
