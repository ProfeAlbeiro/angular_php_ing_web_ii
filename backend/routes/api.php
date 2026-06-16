<?php
// backend/routes/api.php

return [
    // Rutas públicas (no requieren autenticación)
    'POST /api/login' => [
        'controller' => 'AuthController',
        'method' => 'login'
    ],
    'POST /api/register' => [
        'controller' => 'AuthController',
        'method' => 'register'
    ],
    
    // Rutas protegidas (requieren JWT)
    'GET /api/locations' => [
        'controller' => 'LocationsController',
        'method' => 'getAll',
        'auth' => true
    ],
    'GET /api/locations/{id}' => [
        'controller' => 'LocationsController',
        'method' => 'getById',
        'auth' => true
    ],
    'POST /api/locations' => [
        'controller' => 'LocationsController',
        'method' => 'create',
        'auth' => true
    ],
    'PUT /api/locations/{id}' => [
        'controller' => 'LocationsController',
        'method' => 'update',
        'auth' => true
    ],
    'DELETE /api/locations/{id}' => [
        'controller' => 'LocationsController',
        'method' => 'delete',
        'auth' => true
    ]
];