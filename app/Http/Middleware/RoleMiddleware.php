<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $users = Auth::user();

        //Cek jika user tidak login atau tidak memiliki role yang sesuai
        if (!$users || !in_array($users->role, $roles)) {
            return redirect()->route('home')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk mengakses halaman tersebut!');
        }

        return $next($request);
    }
}