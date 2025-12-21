<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ JIKA BELUM LOGIN → IZINKAN (biar bisa login)
        if (!Auth::check()) {
            return $next($request);
        }

        // ❌ JIKA ROLE USER → TOLAK
        if (Auth::user()->role === 'User') {
            abort(403, 'Akses ditolak.');
        }

        // ✅ ADMIN & SUPER ADMIN → BOLEH
        return $next($request);
    }
}
