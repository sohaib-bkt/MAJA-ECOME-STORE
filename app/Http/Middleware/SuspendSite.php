<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuspendSite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Always show the suspended page
        return response()->view('suspended');
    }
}
