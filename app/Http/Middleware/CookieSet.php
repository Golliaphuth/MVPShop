<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CookieSet
{
    public function handle(Request $request, Closure $next)
    {
        if(!$request->hasCookie('uuid-cart')) {
            $uuid = md5(rand(0, 1000) . Carbon::now()->getTimestampMs());
            return $next($request)->withCookie(cookie()->forever('uuid-cart', $uuid));
        }

        return $next($request);
    }
}
