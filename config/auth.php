<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'administradores',
        ],

        'hospede' => [
            'driver' => 'session',
            'provider' => 'hospedes',
        ],

        'administrador' => [
            'driver' => 'session',
            'provider' => 'administradores',
        ],
    ],

    'providers' => [
        'administradores' => [
            'driver' => 'eloquent',
            'model' => App\Models\Administrador::class,
        ],

        'hospedes' => [
            'driver' => 'eloquent',
            'model' => App\Models\Hospede::class,
        ],
    ],

    'passwords' => [
        'administradores' => [
            'provider' => 'administradores',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'hospedes' => [
            'provider' => 'hospedes',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
