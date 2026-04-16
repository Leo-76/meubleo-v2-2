<?php

declare(strict_types=1);

namespace Meubleo\Platform\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->is_admin) {
            abort(403, 'Access reserved for administrators.');
        }
        return $next($request);
    }
}
