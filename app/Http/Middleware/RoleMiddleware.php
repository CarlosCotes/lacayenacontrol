<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Manejar una solicitud entrante.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Verificar si el usuario está autenticado
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Debes iniciar sesión.');
        }

        // Obtener el usuario actual
        $user = auth()->user();

        // Comparar el rol (por número)
        if ($user->role_id != $role) {
            return response()->view('errors.acceso-denegado', [], 403);
        }

        return $next($request);
    }
}
