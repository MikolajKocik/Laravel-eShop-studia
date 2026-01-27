<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403);
        }

        // Bezpiecznik: jeśli role przyszły jako jeden string "admin,assistant"
        if (count($roles) === 1 && str_contains($roles[0], ',')) {
            $roles = array_map('trim', explode(',', $roles[0]));
        }

        if (!in_array($user->role, $roles, true)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
