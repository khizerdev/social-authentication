<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Social
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
        if (!in_array(strtolower($request->service), array_keys(config('social.services')))) {
            return redirect()->back();
        }
        return $next($request);
    }
}
