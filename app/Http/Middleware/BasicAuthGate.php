<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicAuthGate
{
    /**
     * Site-wide HTTP Basic Auth, gated by BASIC_AUTH_ENABLED.
     * Used to keep the site private (and unreachable by search engines)
     * before public launch, without relying on a server-path-dependent
     * .htaccess/.htpasswd setup.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('app.basic_auth_enabled')) {
            return $next($request);
        }

        // Let uptime/health checks through even while the site is gated.
        if ($request->is('up')) {
            return $next($request);
        }

        $user = config('app.basic_auth_username');
        $pass = config('app.basic_auth_password');

        if ($request->getUser() === $user && $request->getPassword() === $pass) {
            return $next($request);
        }

        return response('Authentication required.', 401, [
            'WWW-Authenticate' => 'Basic realm="Rajwada Events"',
        ]);
    }
}
