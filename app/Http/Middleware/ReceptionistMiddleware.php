<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReceptionistMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || (!auth()->user()->isAdmin() && !auth()->user()->isReceptionist())) {
            abort(403, 'Unauthorized. Receptionist access required.');
        }

        return $next($request);
    }
}
