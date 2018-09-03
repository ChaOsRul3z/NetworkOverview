<?php

// TODO translate input field placeholders
// TODO translate delete popup form

return [
    'menu' => [
        'login' => 'Login',
        'register' => 'Register',
        'admin-panel' => 'Admin Panel',
        'sorts' => 'Sorts',
        'properties' => 'Properties',
        'vlans' => 'Vlans',
        'patchcables' => 'Patchcables',
        'devices' => 'Devices',
        'inventory' => 'Inventory',
        'logout' => 'Logout',
    ], // DONE UPDATED
    'building' => [
        'header' => 'Buildings',
        'buttons' => [
            'new' => 'New building',
            'edit' => 'Edit building',
            'delete' => 'Delete building',
        ],
        'new' => [
            'legend' => 'Create building',
            'button' => 'Create',
        ],
        'edit' => [
            'legend' => 'Update building',
            'button' => 'Update',
        ],
        'show' => [
            'header' => ':building-name: floors',
            'empty' => 'No rooms found.',
        ],
        'delete' => [
            'title' => 'Are you sure you want to delete: :building?',
            'body' => 'Everything in this building will be deleted!',
        ]
    ], //DONE UPDATED
    'floor' => [
        'header' => 'Floors',
        'buttons' => [
            'new' => 'New floor',
            'edit' => 'Edit floor',
            'delete' => 'Delete floor',
        ],
        'new' => [
            'legend' => 'New floor',
            'button' => 'Create',
        ],
        'edit' => [
            'legend' => 'Update floor',
            'button' => 'Update',
        ],
        'show' => [
            'header' => '',
            'empty' => '',
        ],
        'delete' => [
            'title' => 'Are you sure you want to delete: :floor?',
            'body' => 'Everything on this floor will be deleted!',
        ],
        'empty' => 'No floors found.',
    ], // DONE UPDATED
    'room' => [
        'header' => 'Rooms',
        'buttons' => [
            'new' => 'New room',
            'edit' => 'Edit room',
            'delete' => 'Delete room',
        ],
        'new' => [
            'legend' => 'New room',
            'button' => 'Create',
        ],
        'edit' => [
            'legend' => 'Update room',
            'button' => 'Update',
        ],
        'show' => [
            'header' => '',
            'empty' => '',
        ],
        'empty' => 'No rooms found.',
    ], // DONE
    'rack' => [
        'header' => 'Racks',
        'buttons' => [
            'new' => 'New rack',
            'edit' => 'Edit rack',
            'delete' => 'Delete rack',
        ],
        'new' => [
            'legend' => 'New rack',
            'button' => 'Create',
        ],
        'edit' => [
            'legend' => 'Update rack',
            'button' => 'Update',
        ],
        'show' => [
            'header' => '',
            'empty' => '',
        ],
        'empty' => 'No racks found.',
    ], // DONE

    'unit' => [],
    'port' => [],
    'patchcable' => [],

    'device' => [
        'header' => 'Devices',
        'buttons' => [
            'new' => 'New device',
            'edit' => 'Edit device',
            'delete' => 'Delete device',
        ],
        'new' => [
            'legend' => 'New device',
            'button' => 'Create',
        ],
        'edit' => [
            'legend' => 'Update device',
            'button' => 'Update',
        ],
        'show' => [
            'header' => '',
            'empty' => '',
        ],
        'empty' => 'No devices found.',
    ], // DONE

    'property' => [],
    'sort' => [],
    'type' => [],
    'vlan' => [
        'header' => 'Vlans',
        'buttons' => [
            'new' => 'New vlan',
            'edit' => 'Edit vlan',
            'delete' => 'Delete vlan',
        ],
        'new' => [
            'legend' => 'New vlan',
            'button' => 'Create',
        ],
        'edit' => [
            'legend' => 'Update vlan',
            'button' => 'Update',
        ],
        'show' => [
            'header' => '',
            'empty' => '',
        ],
        'empty' => 'No vlans found.',
    ], // DONE
];