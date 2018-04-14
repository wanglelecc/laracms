<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $action = $request->route()->getAction();
            $redirectUrl = (isset($action['domain']) && config('administrator.domain') == $action['domain']) || (  isset($action['prefix']) && '/'. config('administrator.domain') == $action['prefix']) ?
                route('administrator.dashboard') : '/';
            return redirect($redirectUrl);
        }

        return $next($request);
    }
}
