<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $userRole = Auth::user()->phanquyen;

            // Check if the user's role is in the array of allowed roles
            if (in_array($userRole, $roles)) {
                return $next($request);
            }

            // If the user's role is not in the allowed roles, return 403
            return abort(403, 'Unauthorized action.');
        }

        // If the user is not authenticated, redirect to login
        return redirect()->route('route.login');
    }

}
