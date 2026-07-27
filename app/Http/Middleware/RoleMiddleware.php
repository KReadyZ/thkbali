<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki hak akses untuk halaman ini.'
                ], 403);
            }

            if ($role === 'admin') {
                return redirect()->route('admin.login')->withErrors(['auth' => 'Anda tidak memiliki hak akses administrator.']);
            }

            if ($role === 'asesor') {
                return redirect()->route('home')->withErrors(['auth' => 'Anda tidak memiliki hak akses asesor.']);
            }

            return redirect()->route('home')->withErrors(['auth' => 'Hak akses tidak valid.']);
        }

        return $next($request);
    }
}
