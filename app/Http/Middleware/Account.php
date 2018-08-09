<?php

namespace App\Http\Middleware;

use App\Customer;
use App\Http\Controllers\AccountController;
use Closure;
use Illuminate\Support\Facades\Auth;

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

        #account(customer code) is not existing in database will go back to screen
        if (Auth::user()->isUser()) {
            if (!session('account')) {
                return redirect('home');
            }
        }

        return $next($request);
    }
}
