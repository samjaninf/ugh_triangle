<?php

namespace App\Http\Middleware;

use Closure;

class AllowAjaxRequestsOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Checks if the reuqest is ajax
        if ($request->ajax() == false) {
            // if it is not return an error
            return response('Bad request', 405);
        }
        return $next($request);
    }
}
