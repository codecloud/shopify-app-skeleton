<?php
return [
    'urls' => [
        'install'                   => env('APP_URL') . '/shopify-install/begin',
        'confirm_installation'      => env('APP_URL') . '/shopify-install/confirm',
        'post_install_redirect_uri' => env('APP_URL') . '/shopify-install/complete'
    ],
    'keys' => [
        'api_key'    => '26f829b7d9e2da4f1592992d2dc44606',
        'secret_key' => '4a8e0703c928dae7bf905b36bd7c8cfe'
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
    ]
];