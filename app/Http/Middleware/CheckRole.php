<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        Log::info('CheckRole middleware started at: ' . $startTime);
        
        // Try cache first untuk menghindari session lookup
        $sessionId = $request->session()->getId();
        $cacheKey = 'portal_data_' . $sessionId;
        
        $cacheStart = microtime(true);
        $portalData = Cache::get($cacheKey);
        $cacheEnd = microtime(true);
        $cacheDuration = ($cacheEnd - $cacheStart) * 1000;
        Log::info('Cache lookup completed in: ' . $cacheDuration . 'ms');
        
        if (!$portalData) {
            $sessionLookupStart = microtime(true);
            $portalData = session()->get('portal_data');
            $sessionLookupEnd = microtime(true);
            $sessionLookupDuration = ($sessionLookupEnd - $sessionLookupStart) * 1000;
            Log::info('Session lookup completed in: ' . $sessionLookupDuration . 'ms');
            
            // Cache the result untuk next request
            if ($portalData) {
                Cache::put($cacheKey, $portalData, now()->addMinutes(30));
                Log::info('Portal data cached for 30 minutes');
            }
        } else {
            Log::info('Portal data retrieved from cache');
        }
        
        if($portalData){
            $endTime = microtime(true);
            $duration = ($endTime - $startTime) * 1000;
            Log::info('CheckRole middleware completed in: ' . $duration . 'ms');
            return $next($request);
        }
        
        $endTime = microtime(true);
        $duration = ($endTime - $startTime) * 1000;
        Log::info('CheckRole middleware redirecting to login in: ' . $duration . 'ms');
        return redirect()->route('login');
    }
}
