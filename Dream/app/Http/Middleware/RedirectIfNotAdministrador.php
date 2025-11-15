<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdministrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el administrador está autenticado
        if (!Auth::guard('administrador')->check()) {
            // Si no está autenticado, redirigir al login de admin
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
