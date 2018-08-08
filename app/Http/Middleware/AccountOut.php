<?php

namespace App\Http\Middleware;

use Closure;

class AccountOut
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
        if (session('account')) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
