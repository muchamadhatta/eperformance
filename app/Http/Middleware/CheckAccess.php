<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccess
{
    public function handle($request, Closure $next)
    {
        if (empty($request->session()->get('portal_data')->peran['eperformance'])) {
            return response("Pengguna ini belum mempunyai hak akses pada Aplikasi E-Performance DPR-RI", 403);
        }

        return $next($request);
    }
}
