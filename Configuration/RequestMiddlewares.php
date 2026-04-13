<?php

return [
    'backend' => [
        'wapplersystems/save-and-close/js-loader' => [
            'target' => \WapplerSystems\SaveAndClose\Middleware\SaveAndCloseJsLoader::class,
            'after' => [
                'typo3/cms-backend/authentication',
            ],
        ],
    ],
];