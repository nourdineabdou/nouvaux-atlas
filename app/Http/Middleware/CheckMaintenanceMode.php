<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $enabled = config('app.maintenance_page_enabled', false);

        if ($enabled) {
            $except = [
                'admin*',
                'maintenance*',
                'assets/*',
                'css/*',
                'js/*',
                'images/*',
                'favicon.ico',
            ];

            if (! $request->is($except)) {
                return response()->view('maintenance', [], 503);
            }
        }

        return $next($request);
    }
}
