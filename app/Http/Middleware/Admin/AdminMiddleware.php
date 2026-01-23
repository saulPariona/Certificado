<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response // esto en cada peticion ese usuario debe ser un administrador
    {
        $user = $request->user(); // aqui se obtiene el usuario autenticado, el user() es para obtener el usuario autenticado
        if ($user->isAn('admin')) { // aqui se verifica si el usuario es admin, el isAn() es para verificar si el usuario es admin
            return $next($request); // si es admin se permite el acceso
        }
        return redirect()->route('logout'); // si no es admin se redirige al logout, que lo desloguea
    }
}
