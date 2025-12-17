<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
// ← ini wajib

class CheckIsLogin
{
    public function handle($request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route('auth.index')->withErrors('Silahkan login terlebih dahulu!');
        }

        return $next($request);
    }
}
