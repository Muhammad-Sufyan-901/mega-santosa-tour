<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            // If not authenticated, redirect to login with intended URL
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman admin.');
        }

        // User is authenticated, allow access
        return $next($request);
    }
}
