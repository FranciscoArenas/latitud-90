<?php
// Este script verifica si los assets de Vite están disponibles y correctamente configurados

// Verificar si existe el manifiesto de Vite
$manifestPath = __DIR__ . '/build/manifest.json';
$manifestExists = file_exists($manifestPath);
$manifestContent = $manifestExists ? json_decode(file_get_contents($manifestPath), true) : null;

// Información del entorno
$env = [
    'APP_ENV' => getenv('APP_ENV'),
    'APP_URL' => getenv('APP_URL'),
    'ASSET_URL' => getenv('ASSET_URL'),
    'VITE_HMR_HOST' => getenv('VITE_HMR_HOST'),
    'VITE_HMR_PORT' => getenv('VITE_HMR_PORT'),
];

// Rutas importantes para el frontend
$paths = [
    'manifest' => $manifestPath,
    'app.js' => __DIR__ . '/build/assets/' . ($manifestContent && isset($manifestContent['resources/js/app.js']) ? $manifestContent['resources/js/app.js']['file'] : 'app.js'),
];

// Comprobar si los archivos existen
$fileChecks = [];
foreach ($paths as $key => $path) {
    $fileChecks[$key] = [
        'path' => $path,
        'exists' => file_exists($path),
        'size' => file_exists($path) ? filesize($path) : 0,
        'modified' => file_exists($path) ? date('Y-m-d H:i:s', filemtime($path)) : 'N/A',
    ];
}

// Generar respuesta
$response = [
    'status' => 'running',
    'laravel_version' => app()->version(),
    'env' => $env,
    'manifest' => [
        'exists' => $manifestExists,
        'entries' => $manifestExists ? count($manifestContent) : 0,
    ],
    'file_checks' => $fileChecks,
    'server' => $_SERVER,
];

// Mostrar resultados
header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);
