<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and if they are an admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Redirect to the login page if the user is not an admin
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
