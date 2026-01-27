<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccess
{
    public function handle($request, Closure $next)
    {
        if (empty($request->session()->get('portal_data')->peran['eperformance'])) {
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
