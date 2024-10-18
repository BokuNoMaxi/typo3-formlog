<?php

use Pagemachine\Formlog\Controller\Backend\FormLogSuggestController;

return [
    'formlog_suggest' => [
        'path' => '/formlog/suggest/search',
        'target' => FormLogSuggestController::class . '::searchAction',
    ],
];
