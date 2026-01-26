<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class CheckAccess
{
    public function handle($request, Closure $next)
    {
        $startTime = microtime(true);
        Log::info('CheckAccess middleware started at: ' . $startTime);
        
        if (empty($request->session()->get('portal_data')->peran['eperformance'])) {
            $endTime = microtime(true);
            $duration = ($endTime - $startTime) * 1000;
            Log::info('CheckAccess middleware denied access in: ' . $duration . 'ms');
            return response("Pengguna ini belum mempunyai hak akses pada Aplikasi E-Performance DPR-RI", 403);
        }

        $endTime = microtime(true);
        $duration = ($endTime - $startTime) * 1000;
        Log::info('CheckAccess middleware completed in: ' . $duration . 'ms');
        return $next($request);
    }
}
