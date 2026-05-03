<?php

return [
    [
        'title' => 'School Settings',
        'icon' => 'settings',
        'route' => 'admin::school-settings.index',
    ],
    [
        'title' => 'Management',
        'children' => [
            [
                'title' => 'Guru',
                'route' => 'admin::teachers.index'
            ]
        ]
    ]
];
