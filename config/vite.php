<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Vite Asset URL
    |--------------------------------------------------------------------------
    |
    | This value sets the URL to use for Vite assets. If null, Laravel-Vite
    | will use the value of the APP_URL environment variable.
    |
    */
    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Vite Entry Points
    |--------------------------------------------------------------------------
    |
    | The entry points for Vite.
    |
    */
    'entry_points' => [
        'resources/js/app.js',
    ],

    /*
    |--------------------------------------------------------------------------
    | Vite Build Path
    |--------------------------------------------------------------------------
    |
    | The path where Vite will build assets relative to the public directory.
    |
    */
    'build_path' => 'build',

    /*
    |--------------------------------------------------------------------------
    | Vite Development Server
    |--------------------------------------------------------------------------
    |
    | Configuration for the Vite development server.
    |
    */
    'dev_server' => [
        'enabled' => env('VITE_DEV_SERVER_ENABLED', false),
        'host' => env('VITE_HMR_HOST', 'localhost'),
        'port' => env('VITE_HMR_PORT', 5173),
    ],
];
