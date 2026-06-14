<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{    /**
     * Create a new middleware instance.
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    $userrole = strtolower($user->rolename ?? '');

    if (!in_array($userrole, $roles, true)) {
        abort(403, 'Onvoldoende rechten');
    }

    return $next($request);
}
}