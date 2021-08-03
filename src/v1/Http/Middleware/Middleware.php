<?php

namespace EcoOnline\EcoPackage\Http\Middleware;

use App;
use Closure;
use Illuminate\Support\Facades\Log;

/**
 * Class Middleware
 *
 * @package EcoOnline\EcoPackage
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
