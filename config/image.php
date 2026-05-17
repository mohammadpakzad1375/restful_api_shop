<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Service Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Image Service. Set values such as default
    | storage disk, image name strategy, and allowed image extensions.
    |
    */

    'available_name_generators' => [
        'customName',
        'originalName',
        'timestamp'
    ],

    'default_name_generator' => 'timestamp',
];
