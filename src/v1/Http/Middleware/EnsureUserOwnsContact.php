<?php

namespace EcoOnline\ContactManagerApi\v1\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserOwnsContact
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $contact = $request->route('contact');
        if ($contact && $request->user()->cannot('view', $contact)) {
            return response(null, 403);
        }

        return $next($request);
    }
}
