<?php

return [
    \Myrtle\Core\Docks\VendorsDock::class => [
        'access-admin' => 'Access Administrative Routes',
        'admin' => 'Administrator',
        'create' => 'Create',
        'delete' => 'Delete',
        'edit' => 'Edit',
        'view' => 'View',
        \Myrtle\Core\Commodities\Models\Commodity::class => [
            'edit' => 'Commodities Edit',
        ],
        \Myrtle\Core\Locations\Models\Location::class => [
            'create' => 'Locations Create',
            'edit' => 'Locations Edit',
            'view' => 'Locations View',
        ],
    ],
    \Myrtle\Core\Vendors\Models\Vendor::class => [
        'delete' => 'Delete',
        'edit' => 'Edit',
        'view' => 'View',
        \Myrtle\Core\Commodities\Models\Commodity::class => [
            'edit' => 'Commodities Edit',
        ],
        \Myrtle\Core\Locations\Models\Location::class => [
            'create' => 'Locations Create',
            'edit' => 'Locations Edit',
            'view' => 'Locations View',
        ],
    ]
];