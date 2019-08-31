<?php

namespace Wanglelecc\Laracms\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FrontendRequests
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
        if( config("system.common.basic.status", 0) != 0 ){
            return abort(403,  config("system.common.basic.close_tips", '非常抱歉，站点正在维护，稍后恢复...'));
        }

        return $next($request);
    }
}
