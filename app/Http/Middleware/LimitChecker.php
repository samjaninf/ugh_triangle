<?php

namespace App\Http\Middleware;

use App\Profile;
use Closure;

class LimitChecker
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
        $limit = \Auth::user()->getLimits()["profile"];
        if (Profile::where('user_id', \Auth::user()->id)->count() >= $limit) {
            return \Redirect::back()->with('error', 'You have reached your profile limit. Remove some of your existing profiles or buy a bigger plan in order ot get bigger limits');
        }
        return $next($request);
    }
}
