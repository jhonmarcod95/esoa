<?php

namespace App\Http\Middleware;

use App\Customer;
use App\Http\Controllers\AccountController;
use Closure;

class Account
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

        #account is not existing in database will go back to screen
        if(!session('account')){
            return redirect('home');
        }

        return $next($request);
    }
}
