<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyUserPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->guard($guard)->check()) {
            $pass = auth()->user()->getAuthPassword();
            if(empty($pass))
            {
                return redirect()->route('auth.setPassword.get');

//                view()->share('is_password_set', auth()->check() ? empty(auth()->user()->getAuthPassword()) : false);
            }
        }

        return $next($request);
    }
}
