<?php

namespace Modules\MagangPustekinfo\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PortalAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated through portal system
        if (!session()->has('portal_data') || !session('portal_data')) {
            return redirect('/login');
        }

        return $next($request);
    }
}