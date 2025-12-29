<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Si no está logueado, al login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role;

        // Si el rol del usuario está permitido, adelante
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // SI NO TIENE PERMISO: Aquí estaba el error del bucle. 
        // No lo mandes a /admin si ya está en una ruta protegida de /admin.
        // Mandalo a una página neutral o al home.
        return redirect('/home')->with('error', 'No tienes permisos de acceso.');
    }

    
}