<?php

namespace App\Http\Middleware;

use Closure;

class Language
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
        if (\Session::has('lang')) {
            \App::setLocale(\Session::get('lang'));
        } else {
            $langs = scandir(base_path('resources/lang'));
            \Session::put('lang', $langs[2]);
        }
        return $next($request);
    }
}
