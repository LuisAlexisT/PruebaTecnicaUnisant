<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // Aquí normalmente va la redirección:
            // return route('login');

            // En su lugar:
            abort(response()->json(['error' => 'Sin autorización'], 401));
    }    }
}
