<?php
session_start();
require "app/Session.php";
$config['app'] = [
    'name'=>'PR LOG Viewer',
    'desc'=>'The tool you can se the log by ONLY one CLICK! (actually with three clicks)'
];
$config['with_md5']=false;
#$config['date_format']="Y-m-d";
#$config['hour_format']="H:i:s";

// Brazilian time
$config['date_format']="d/m/Y";
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
        'name' => 'DIVSUL - BR',
        'path' => 'http://logs.divsul.com:666/PRServer/logs/ra_adminlog_main.txt',
        'local_name' => 'divsul_01_main.txt',
    ];

/*
 * 
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
 */

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
            'value' => 'MAPVOTE'
        ],
        [
            'name' => 'REPORT',
            'color' => 'danger',
            'value' => 'REPORT'
        ],
        [
            'name' => 'REPORT PLAYER',
            'color' => 'danger',
            'value' => 'REPORTP'
        ],
        [
            'name' => 'WARNING',
            'color' => 'warning',
            'value' => 'WARN'
        ],
        [
            'name' => 'KICK',
            'color' => 'danger',
            'value' => 'KICK'
        ],
        [
            'name' => 'TEMP BAN',
            'color' => 'danger',
            'value' => 'TEMPBAN'
        ],
        [
            'name' => 'PERM BAN',
            'color' => 'danger',
            'value' => 'BAN'
        ],
        [
            'name' => 'RESIGN',
            'color' => 'danger',
            'value' => 'RESIGN'
        ],
        [
            'name' => 'SAY',
            'color' => 'danger',
            'value' => 'SAY'
        ],
        [
            'name' => 'SWITCH',
            'color' => 'danger',
            'value' => 'SWITCH'
        ]
];
