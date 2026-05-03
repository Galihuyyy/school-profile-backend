<?php

return [
    [
        'title' => 'School Settings',
        'icon' => 'settings',
        'route' => 'admin::school-settings.index',
    ],
    [
        'title' => 'MANAGEMENT',
        'children' => [
            [
                'title' => 'Guru',
                'route' => 'admin::teachers.index',
            ],
            [
                'title' => 'Lowongan',
                'route' => 'admin::jobs.index',
            ],
            [
                'title' => 'Posts',
                'route' => 'admin::posts.index',
            ],
                'route' => 'admin::teachers.index'
            ],
            [
                'title' => 'Jurusan',
                'route' => 'admin::departments.index'
            ]
        ]
    ]
];
