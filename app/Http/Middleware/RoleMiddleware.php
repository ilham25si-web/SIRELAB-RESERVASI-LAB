<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // 1. ambil pengguna yang sedang login: $request->user()

        // 2. kalau role-nya TIDAK termasuk dalam $roles → tolak
        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // 3. kalau lolos, lanjutkan ke tujuan semula
        return $next($request);
    }
}