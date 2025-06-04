<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class RedirectIfAuthenticatedApi
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Intenta obtener el usuario del token
            $user = JWTAuth::parseToken()->authenticate();
            if ($user) {
                // Si hay usuario autenticado, responde con error JSON
                return response()->json([
                    'message' => 'Ya estás autenticado',
                ], 403);
            }
        } catch (\Exception $e) {
            // Si no hay token o es inválido, seguimos adelante
        }

        return $next($request);
    }
}
