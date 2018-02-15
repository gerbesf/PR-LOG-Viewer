<?php
session_start();
require "app/Session.php";

/* ----------- APP ---------- */
$config['app'] = [
    'name'=>'PR LOG Viewer',
    'desc'=>'The tool you can se the log by ONLY one CLICK! (actually with three clicks)'
];

/* ---------- DATE ---------- */
$config['date_format']="Y-m-d";
$config['hour_format']="H:i:s";


/* ---------- AUTH ---------- */
$config['require_login'] = false;
$config['with_md5']=false;

// Hide Full IP
$config['hide_ips'] = false;

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
    'id' => 1, // sequential please
    'name' => 'DIVSUL-BR', // server display name

    // log files
    'path' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog_main.txt', // for complete log, after restart
    'active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog.txt', // for active log, before restart

    // hash files
    'path_hash' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash_main.txt', // for complete log, after restart
    'hash_active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash.txt', // for active log, before restart

    'local_name' => 'divsul_01_main.txt', // local created base filename
];
$config['servers_list'][] = [
    'id' => 2, // sequential please
    'name' => 'NWG', // server display name

    // log files
    'path' => 'http://192.154.108.178:666/logs/ra_adminlog_main.txt', // for complete log, after restart
    'active_log' => 'http://192.154.108.178:666/logs/ra_adminlog.txt', // for active log, before restart

    // hash files
    'path_hash' => 'http://192.154.108.178:666/logs/cdhash_main.txt', // for complete log, after restart
    'hash_active_log' => 'http://192.154.108.178:666/logs/cdhash.txt', // for active log, before restart

    'local_name' => 'n2g_02_main.txt', // local created base filename
];

/*
 * $config['servers_list'][] = [
        'id' => 2,
        'name' => 'DIVSUL - US',

        // log files
        'path' => '',
        'active_log' => '',

        // hash files
        'path_hash' => '',
        'hash_active_log' => '',

        'local_name' => 'divsul_01_main.txt',
    ];

 */

/* --------- COMMANDS --------- */
$config['server_commands'] = [
    [
        'name' => 'SETNEXT',
        'color' => 'success',
        'value' => ['SETNEXT']
    ],
    [
        'name' => 'MAPVOTE',
        'color' => 'success',
        'value' => ['MAPVOTE']
    ],
    [
        'name' => 'REPORT',
        'color' => 'danger',
        'value' => ['REPORT']
    ],
    [
        'name' => 'REPORT PLAYER',
        'color' => 'danger',
        'value' => ['REPORTP']
    ],
    [
        'name' => 'WARNING',
        'color' => 'warning',
        'value' => ['WARN']
    ],
    [
        'name' => 'KICK',
        'color' => 'danger',
        'value' => ['KICK']
    ],
    [
        'name' => 'TEMP BAN',
        'color' => 'danger',
        'value' => ['TEMPBAN']
    ],
    [
        'name' => 'PERM BAN',
        'color' => 'danger',
        'value' => ['BAN']
    ],
    [
        'name' => 'RESIGN',
        'color' => 'danger',
        'value' => ['RESIGN']
    ],
    [
        'name' => 'HISTORY',
        'color' => 'danger',
        'value' => ['HISTORY',]
    ],
    [
        'name' => 'SCRAMBLE',
        'color' => 'danger',
        'value' => ['SCRAMBLE']
    ],
    [
        'name' => 'SAY / SAYTEAM',
        'color' => 'danger',
        'value' => ['SAY','SAYTEAM']
    ],
    [
        'name' => 'SWITCH',
        'color' => 'danger',
        'value' => ['SWITCH']
    ],

    [
        'name' => 'FLY',
        'color' => 'danger',
        'value' => ['FLY']
    ],

    [
        'name' => 'UNBAN',
        'color' => 'danger',
        'value' => ['UNBAN']
    ],

    [
        'name' => 'INIT',
        'color' => 'primary',
        'value' => 'INIT'
    ],
    [
        'name' => 'RELOAD',
        'color' => 'primary',
        'value' => 'RELOAD'
    ],
    [
        'name' => 'TICKETS',
        'color' => 'warning',
        'value' => 'TICKETS'
    ],

    [
        'name' => 'TIMEBAN',
        'color' => 'danger',
        'value' => 'TIMEBAN'
    ],

    [
        'name' => 'STOPSERVER',
        'color' => 'danger',
        'value' => 'STOPSERVER'
    ],

    [
        'name' => 'MESSAGE',
        'color' => 'danger',
        'value' => 'MESSAGE'
    ],

    [
        'name' => 'KILL',
        'color' => 'danger',
        'value' => 'KILL'
    ],

    [
        'name' => 'RESIGNALL',
        'color' => 'danger',
        'value' => 'RESIGNALL'
    ],
    [
        'name' => 'SWAPTEAMS',
        'color' => 'danger',
        'value' => 'SWAPTEAMS'
    ],
];

// Share on globals
$GLOBALS['config'] = $config;