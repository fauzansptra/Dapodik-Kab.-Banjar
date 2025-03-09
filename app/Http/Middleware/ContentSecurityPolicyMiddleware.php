<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Define CSP based on the environment
        if (app()->environment('local')) {
            // Less strict CSP for development
            $csp = "default-src 'self'; script-src 'self' 'unsafe-eval' https://cdn.jsdelivr.net https://unpkg.com https://cdnjs.cloudflare.com;";
        } else {
            // Production CSP with 'unsafe-eval' (Not recommended, but if necessary)
            $csp = "default-src 'self'; script-src 'self' 'unsafe-eval' https://cdn.jsdelivr.net https://unpkg.com https://cdnjs.cloudflare.com; object-src 'none'; base-uri 'self'; frame-ancestors 'none';";
        }

        // Set CSP header
        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
