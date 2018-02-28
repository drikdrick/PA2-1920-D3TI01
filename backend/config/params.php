<?php
return [
    'adminEmail' => 'admin@example.com',
    'applicationID' => 'SYSTEMX-BACKEND',
    'authenticatedRoleName' => 'authenticated',
    'sidebarMenu' => [
                        [
                            'label' => 'System Administration',
                            'icon' => 'fa fa-dashboard',
                            'childs' => [
                                [
                                    'label' => 'User List',
                                    'url' => '/admin/user/index',
                                    'icon' => 'fa fa-users',
                                ],
                                [
                                    'label' => 'Add User',
                                    'url' => '/admin/user/add',
                                    'icon' => 'fa fa-plus',
                                ],
                            ]
                        ],
                        [
                            'label' => 'Contoh Menu',
                            'icon' => 'fa fa-dashboard',
                            'url' => '/test'
                        ],
                	],
];
