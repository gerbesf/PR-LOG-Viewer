<?php
session_start();
require "app/Session.php";
$config['app'] = [
    'name'=>'PR LOG Viewer',
    'desc'=>'The tool you can se the log by ONLY one CLICK! (actually with three clicks)'
];
$config['with_md5']=false;
$config['date_format']="Y-m-d";
$config['hour_format']="H:i:s";

/* --------- USERS --------- */
$config['auth'] = [
    0 => [
        'id' => 1,
        'username' => 'admin',
        'password' => 'admin',
        'name'=>'Administrator'
    ],
    1 => [
        'id' => 1,
        'username' => 'custom',
        'password' => 'custom',
        'name'=>'Administrator'
    ],
];

/* --------- SERVERS --------- */
$config['servers_list'][] = [
        'id' => 1,
        'name' => 'SERVER 01',
        'path' => 'http://server01.divsul.com:666/ra_adminlog.txt'
    ];

$config['servers_list'][] = [
    'id' => 2,
    'name' => 'SERVER 02',
    'path' => 'http://server02.divsul.com:666/ra_adminlog.txt'
];

$config['servers_list'][] = [
    'id' => 3,
    'name' => 'SERVER 03',
    'path' => 'http://149.56.165.176:666/logs/ra_adminlog.txt'
];

/* --------- COMMANDS --------- */
$config['server_commands'] = [
    [
        'name' => 'SETNEXT',
        'color' => 'success',
        'value' => 'SETNEXT'
    ],
    [
        'name' => 'MAPVOTE',
        'color' => 'success',
        'value' => 'MVOTE'
    ],
    [
        'name' => 'REPORT',
        'color' => 'danger',
        'value' => 'R'
    ],
    [
        'name' => 'WARNING',
        'color' => 'warning',
        'value' => 'W'
    ],
    [
        'name' => 'KICK',
        'color' => 'danger',
        'value' => 'KICK'
    ],
    [
        'name' => 'TEMP BAN',
        'color' => 'danger',
        'value' => 'TB'
    ],
    [
        'name' => 'PERM BAN',
        'color' => 'danger',
        'value' => 'B'
    ]
];
