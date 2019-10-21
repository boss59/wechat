<?php

namespace App\Http\Middleware;

use Closure;

class Checkwechat
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
        if (!session()->has('info')) {
            return redirect('/wechat/add');
        }
        return $next($request);
    }
}
