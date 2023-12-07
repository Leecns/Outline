<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server Availability Check Timeout
    |--------------------------------------------------------------------------
    |
    |
    */

    'server_availability_check_timeout' => env('OUTLINE_SERVER_AVAILABILITY_CHECK_TIMEOUT', 5),

    /*
    |--------------------------------------------------------------------------
    | Access Kay Encryption Method
    |--------------------------------------------------------------------------
    |
    | This configuration specifies which encryption method will be used by Outline VPN.
    |
    */

    'encryption_method' => env('OUTLINE_ENCRYPTION_METHOD', 'aes-192-gcm'),

    /*
    |--------------------------------------------------------------------------
    | Setup Script
    |--------------------------------------------------------------------------
    |
    | This script will be displayed to users to setting up a new server for Outline VPN.
    |
    */
    'setup_script' => 'sudo bash -c "$(wget -qO- https://raw.githubusercontent.com/Jigsaw-Code/outline-server/master/src/server_manager/install_scripts/install_server.sh)"'
];

