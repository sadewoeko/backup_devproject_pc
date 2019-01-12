<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Remote Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default connection that will be used for SSH
    | operations. This name should correspond to a connection name below
    | in the server list. Each connection will be manually accessible.
    |
     */

    'default' => 'merah_putih',

    /*
    |--------------------------------------------------------------------------
    | Remote Server Connections
    |--------------------------------------------------------------------------
    |
    | These are the servers that will be accessible via the Remote class.
    | Each server is identified by a key and necessary authentication options:
    |
    | - host
    | - port
    | - username
    | - key and keyphrase if you are SSH'ing using authorized keys
    | - password if you're using a password.
    |
    | Note: login with key has higher priority. Which means, Remote will only
    | attempt to log in via username/password if key is empty.
    |
     */

    'connections' => [

        'production' => [
            'host'      => '127.0.0.1',
            'port'      => 22,
            'username'  => 'root',
            'key'       => dirname(__FILE__).'./../tests/keys/id_rsa',
            'keyphrase' => '',
            'password'  => '',
        ],
		
		'merah_putih' => [
            'host'      => '10.251.94.47',
            'port'      => 22,
            'username'  => 'apps',
            'key'       => app_path().'/ServiceDesk-MP.ppk',
            'keyphrase' => 'Bismillah123',
            'password'  => '',
        ],

        'staging' => [
            'host'      => '::1',
            'port'      => 22,
            'username'  => 'dev',
            'key'       => '',
            'keyphrase' => '',
            'password'  => 'SoSecureMuchWow',
        ],

    ],

];
