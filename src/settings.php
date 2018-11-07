<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'db' => [
            'host' => 'ec2-184-73-222-192.compute-1.amazonaws.com',
            'user' => 'qtpqokeptciffb',
            'pass' => 'f9263812b096bad56e4becf49cafeb2215f27e45688d114dd7b1c5ebea91cf73',
            'dbname' => 'dec6cn03h4f4al',
            'driver' => 'pgsql'
        ]
    ],
];
