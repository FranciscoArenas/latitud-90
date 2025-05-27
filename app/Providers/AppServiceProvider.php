<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Optimización de rutas para entornos de producción
        if ($this->app->environment('production')) {
            $this->app->singleton(\Illuminate\Routing\UrlGenerator::class, function ($app) {
                $routes = $app['router']->getRoutes();
                $app = $app->rebinding(
                    'request',
                    $this->requestRebinder()
                );
                
                $url = new \Illuminate\Routing\UrlGenerator(
                    $routes, $app->make('request')
                );
                
                // Forzar HTTPS en producción
                $url->forceScheme('https');
                
                return $url;
            });
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Optimización de memoria
        if ($this->app->environment('production')) {
            \Illuminate\Database\Eloquent\Model::preventLazyLoading(!$this->app->isProduction());
            \Illuminate\Database\Eloquent\Model::preventAccessingMissingAttributes(!$this->app->isProduction());
            \Illuminate\Database\Eloquent\Model::preventsModelEvents(fn() => $this->app->isProduction());
        }
        
        // Optimización de Inertia
        \Inertia\Inertia::share([
            'appName' => config('app.name'),
            'flash' => function () {
                return [
                    'success' => session('success'),
                    'error' => session('error'),
                    'warning' => session('warning'),
                    'info' => session('info'),
                ];
            },
            'auth' => function () {
                return [
                    'user' => auth()->user() ? [
                        'id' => auth()->user()->id,
                        'name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                    ] : null,
                ];
            },
        ]);
        
        // Compartimos la configuración de Ziggy
        \Inertia\Inertia::share('ziggy', function () {
            return [
                'url' => config('app.url'),
                'port' => parse_url(config('app.url'), PHP_URL_PORT) ?: null,
            ];
        });
    }
}
