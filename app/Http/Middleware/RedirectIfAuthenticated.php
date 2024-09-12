<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $allowedRoutes = [
            'register', // Route d'inscription
            'login',    // Route de connexion
        ];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && !in_array($request->route()->getName(), $allowedRoutes)) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }

}
