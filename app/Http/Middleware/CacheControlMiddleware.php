<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheControlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        $path = $request->path();
        $isStaticResource = false;
        
        // Comprobar si es un recurso estático basado en la URL y extensión
        if (strpos($path, 'build/assets/') !== false || strpos($path, 'storage/') !== false) {
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $staticExtensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'woff', 'woff2', 'ttf', 'eot', 'ico', 'json', 'map'];
            
            if (in_array($extension, $staticExtensions)) {
                $isStaticResource = true;
                // Caché agresiva para recursos estáticos con hash en su nombre de archivo
                if (preg_match('/-[a-zA-Z0-9]{8}\.[a-z]+$/', $path)) {
                    $response->headers->add([
                        'Cache-Control' => 'public, max-age=31536000, immutable',
                        'Expires' => gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT'
                    ]);
                } else {
                    // Para recursos estáticos sin hash, usar una caché más moderada
                    $response->headers->add([
                        'Cache-Control' => 'public, max-age=86400',  // 1 día
                        'Expires' => gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT'
                    ]);
                }
            }
        }
        
        // Para solicitudes que no son recursos estáticos
        if (!$isStaticResource) {
            if ($request->expectsJson() || $request->header('X-Inertia')) {
                // Para solicitudes AJAX o Inertia, evitar caché completamente
                $response->headers->add([
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, private',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ]);
            } else {
                // Para páginas HTML normales, usar caché moderada para mejorar rendimiento
                $response->headers->add([
                    'Cache-Control' => 'private, no-cache, max-age=0, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ]);
            }
        }

        return $response;
    }
}
