<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasAnyRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Obtiene el rol del usuario actual
        $userRole = $request->user()->role_id;

        // Verifica si el rol del usuario está en la lista de roles permitidos
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Si el rol del usuario no está en la lista, redirecciona con un mensaje de error
        $url = $request->url();
        return redirect('dashboard')->with('error', "Acceso denegado a {$url}");
    }
}
