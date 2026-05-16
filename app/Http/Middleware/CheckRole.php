<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Verificamos que el usuario esté autenticado y tenga el rol requerido
        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request);
        }

        // Si no tiene el rol, lo bloqueamos (Error 403 Prohibido)
        abort(403, 'No tienes permiso para acceder a esta sección.');
    }
}