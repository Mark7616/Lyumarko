<?php
return 
    'connections' => [
        'value' => [
            'defult' => [
                'host' => 'MySQL-8.0',
                'database' => '',
                'login' => 'root',
                'password' => ''
            ],
            'localhost' => [
                'host' => 'MongoDb',
                'database' => '',
                'login' => 'root',
                'password' => ''
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
        ],
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