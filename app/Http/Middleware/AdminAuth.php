<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('admin_logged') === true) {
            return $next($request);
        }

        // if AJAX, return 401 JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        return redirect()->guest(url('admin/login'));
    }
}
