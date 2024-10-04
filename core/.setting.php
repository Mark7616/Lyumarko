<?php
return [
    'connections' => [
        'value' => [
            'defult' => [
                'host' => '',
                'database' => '',
                'login' => 'root',
                'password' => ''
            ]
        ]
    ],
    'session' => [
        'value' => [
            'mode' => 'defult'
        ],
        'readonly ' => true
    ],
    'cookie' => [
        'value' => [
            'secure' => false
            'http_only' => true
        ]
        'read_only' => false
    ],
    'cache_flags' => [
        'value' => [
            'config_options' => 3600,
            'site_domain' => 3600
        ],
        'readonly' => false
    ]
];