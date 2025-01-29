<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // If user has no role, assign a default role
        if (!$user->role) {
            $defaultRole = \App\Models\Role::where('name', 'agent')->first();
            $user->role_id = $defaultRole->id;
            $user->save();
        }

        // Check if user's role matches any of the required roles
        if (in_array($user->role->name, $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}