<?php

use Pagemachine\Formlog\Domain\Model\FormLogEntry;
use Pagemachine\Formlog\Domain\Model\FormLogEntry\Page;

return [
    FormLogEntry::class => [
        'tableName' => 'tx_formlog_entries',
        'properties' => [
            'submissionDate' => [
                'fieldName' => 'crdate',
            ],
            'page' => [
                'fieldName' => 'pid',
            ],
        ],
    ],
    Page::class => [
        'tableName' => 'pages',
    ],
];
