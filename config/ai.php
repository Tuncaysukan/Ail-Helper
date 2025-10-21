<?php

return [

    'default' => env('AI_DRIVER', 'openai'),

    'drivers' => [

        'openai' => [
            'api_key' => env('OPENAI_API_KEY'),
            'model' => 'gpt-4-turbo',
        ],

        'anthropic' => [
            'api_key' => env('ANTHROPIC_API_KEY'),
            'model' => 'claude-3-sonnet',
        ],

    ],

];