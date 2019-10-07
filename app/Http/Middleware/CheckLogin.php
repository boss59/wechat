<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // 防止 非法登陆
    public function handle($request, Closure $next)
    {
        if (!AUth::check()) {
           return redirect('/login');
        }
        return $next($request);
    }
}
