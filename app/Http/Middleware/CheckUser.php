<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (Auth::check()) {
            \Log::info('User Role: ' . Auth::user()->role);
        \Log::info('Allowed Roles: ' . implode(', ', $roles));
            // Check if the user's role is in the array of allowed roles
            if (in_array(Auth::user()->role, $roles)) {
                return $next($request); // Allow the request to proceed
            }
        }

        // If the user is not authorized, redirect or return a response
        return redirect('/login')->with('error', 'You do not have access to this resource.');
    }
}
