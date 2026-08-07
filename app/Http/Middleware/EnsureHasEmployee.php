<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureHasEmployee
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->user()?->employee) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'Akun Anda belum terhubung dengan data karyawan. Hubungi admin HR.');
        }

        return $next($request);
    }
}
