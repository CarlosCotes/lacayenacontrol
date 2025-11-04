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
        // Verifica si el usuario está autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Compara el role_id
        if (auth()->user()->role_id != $role) {
            return redirect()->route('login')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
    }

