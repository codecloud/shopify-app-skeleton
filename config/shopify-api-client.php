<?php
return [
    'urls' => [
        'install'                   => env('APP_URL') . '/shopify-install/begin',
        'confirm_installation'      => env('APP_URL') . '/shopify-install/confirm',
        'post_install_redirect_uri' => env('APP_URL') . '/shopify-install/complete'
    ],
    'keys' => [
        'api_key'    => '93d8b4684b4c3dcaff2d31639612fa69',
        'secret_key' => 'dd05a2588925f0156f5be12eb2d943a5'
    ],
    'scopes' => [
        'read_content',
        'write_content',
        'read_themes',
        'write_themes',
        'read_products',
        'write_products',
        'read_customers',
        'write_customers',
        'read_orders',
        'write_orders',
        'read_script_tags',
        'write_script_tags',
        'read_fulfillments',
        'write_fulfillments',
        'read_shipping',
        'write_shipping',
        'read_analytics',
        'read_users',
        'write_users'
    ]
];