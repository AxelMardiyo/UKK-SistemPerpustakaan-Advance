<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRememberToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Dapatkan token pengguna yang terautentikasi
            $rememberToken = Auth::user()->remember_token;

            // Jika token kosong atau tidak valid, redirect ke halaman login
            if (!$rememberToken || $rememberToken !== $request->cookie('remember_token')) {
                return redirect()->route('login')->withErrors(['message' => 'Akses tidak diizinkan, harap login kembali.']);
            }
        } else {
            // Jika belum login, redirect ke halaman login
            return redirect()->route('login')->withErrors(['message' => 'Silakan login terlebih dahulu.']);
        }

        return $next($request);
    }
}
