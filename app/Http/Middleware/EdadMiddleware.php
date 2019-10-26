<?php

namespace App\Http\Middleware;

use Closure;

class EdadMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->edad <=18)
        {
            abort(403,"!No tienes edad para ver este contenido!.");
        }
        return $next($request);
    }
}
