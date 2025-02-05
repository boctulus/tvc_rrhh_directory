<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Excepción para no redirigir a login si el usuario intenta acceder a una ruta específica
        if ($this->shouldAllowAccess($request)) {
            return null; // No redirigir a login
        }

        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Verifica si la ruta solicitada permite el acceso sin autenticación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function shouldAllowAccess(Request $request): bool
    {
        // Obtener el nombre de la ruta actual
        $currentRoute = Route::currentRouteName();
        
        // Registrar el nombre de la ruta en los logs
        Log::info("Ruta solicitada: " . $currentRoute);
        
        // Verifica si la ruta está permitida
        $allowedRoutes = [
            'personal.index',
        ];

        return in_array($currentRoute, $allowedRoutes);
    }
}
