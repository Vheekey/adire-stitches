<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
        if (\Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME)->with("success", "You are logged in");
        }
        if (\Auth::guard('vendor')->check()) {
            return redirect()->intended('/vendor/dashboard');
        }
        if (\Auth::guard('admin')->check()) {
            return redirect()->intended('/admin/admin');
        }

        return $next($request);
    }
}
