<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = session('app_locale', config('app.locale'));
        if ($locale && in_array($locale, ['en', 'fr'])) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
