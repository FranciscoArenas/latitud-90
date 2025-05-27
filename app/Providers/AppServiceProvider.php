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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Optimiza el renderizado de respuestas Inertia
        \Inertia\Inertia::share('appName', config('app.name'));
        
        // Compartimos la configuración de Ziggy
        \Inertia\Inertia::share('ziggy', [
            'url' => config('app.url'),
            'port' => parse_url(config('app.url'), PHP_URL_PORT) ?: null,
        ]);
    }
}
