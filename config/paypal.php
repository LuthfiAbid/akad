<?php 
return [ 
    'client_id' => env('PAYPAL_CLIENT_ID','AaKtnje_gktGSFSn5vhDXzu1LEjpHyUGjsw_PiIErMnCLgAf0QMyNY0cnwujjMJmEaoVGOzyhE9qiyOk'),
    'secret' => env('PAYPAL_SECRET','EJinJH0lKALlSV7VqFK-634kqQ5--UPiGd9RTLry83u7ekDrAnW88lAJa58JXjsiy5hpQaPepUtxK0UU'),
    'settings' => array(
        'mode' => env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];