<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // jangan lupa import Auth

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika user login dan role sesuai
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika role tidak sesuai → abort 403
        abort(403, 'Akses ditolak.');
    }
}
