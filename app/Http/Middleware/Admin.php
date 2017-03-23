<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if (!\Auth::check()) {
            return \Redirect::to('admin/login');
        } else {
            if (!\Session::has('logged_admin')) {
                return \Redirect::to('admin/login');
            }
        }
        return $next($request);
    }
}
