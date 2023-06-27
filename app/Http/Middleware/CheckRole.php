<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Closure $next, Request $request, string $role)
    {
        if ($role == 'admin' && auth()->user()->role_id != 1) {
            abort(403);
        }

        if ($role == 'guest' && auth()->user()->role_id != 2) {
            abort(403);
        }
    }
}
