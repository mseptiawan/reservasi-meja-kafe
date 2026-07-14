<?php

declare(strict_types=1);

use Flasher\Prime\Configuration;

return Configuration::from([
    'default' => 'sweetalert',

    'main_script' => '/vendor/flasher/flasher.min.js',

    'public_path' => '',

    'styles' => [
        '/vendor/flasher/flasher.min.css',
    ],

    'scripts' => [
        '/vendor/flasher/flasher-sweetalert.min.js',
    ],

    'plugins' => [
        'sweetalert' => [
            'options' => [
                'toast' => true,
                'position' => 'top-end',
                'showConfirmButton' => false,
                'timer' => 4000,
                'timerProgressBar' => true,
            ],
        ],
    ],

    'inject_assets' => true,

    'translate' => true,

    'excluded_paths' => [],

    'flash_bag' => [
        'success' => ['success'],
        'error' => ['error', 'danger'],
        'warning' => ['warning', 'alarm'],
        'info' => ['info', 'notice', 'alert'],
    ],
]);