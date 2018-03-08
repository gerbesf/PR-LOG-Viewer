<?php
session_start();
require "app/Session.php";

/* ----------- APP ---------- */
$config['app'] = [
    'name'=>'PR LOG Viewer',
];

/* ---------- DATE ---------- */
$config['date_format']="Y/m/d";
$config['hour_format']="H:i:s";

/* ---------- AUTH ---------- */
$config['require_login'] = true;
$config['with_md5']=false;

// Hide the last two blocks from the IP
$config['hide_ips'] = false;

/* --------- USERS --------- */
$config['auth'] = [
    0 => [
        'id' => 1,
        'username' => 'admin',
        'password' => 'admin',
        'name'=>'Admin'
    ],
    1 => [
        'id' => 1,
        'username' => 'user',
        'password' => 'user',
        'name'=>'User'
    ],
];

/* --------- SERVERS --------- */

// Local file example for windows:
// 'path' => 'c:/prserver/logs/ra_admin_or_cdhash.txt',

// Local file example for linux:
// 'path' => '/home/prserver/logs/ra_admin_or_cdhash.txt',


$config['servers_list'][] = [
    'id' => 1, // keep the sequential order
    'name' => 'DIVSUL BRA', // server name

    // log files
    'active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog.txt', // filelog 1
    'path' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog_main.txt', // filelog 2

    // hash files
    'hash_active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash.txt', // filelog 1
    'path_hash' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash_main.txt', // filelog 2

    'local_name' => 'divsul_bra.txt', // file name for this server
];

$config['servers_list'][] = [
    'id' => 2, // keep the sequential order
    'name' => 'DIVSUL USA', // server name

    // log files
    'active_log' => 'http://miaserver.divsul.com:666/PRServer/logs/ra_adminlog.txt', // filelog 1
    'path' => 'http://miaserver.divsul.com:666/PRServer/logs/ra_adminlog_main.txt', // filelog 2

    // hash files
    'hash_active_log' => 'http://miaserver.divsul.com:666/PRServer/logs/cdhash.txt', // filelog 1
    'path_hash' => 'http://miaserver.divsul.com:666/PRServer/logs/cdhash_main.txt', // filelog 2

    'local_name' => 'divsul_usa.txt', // file name for this server
];

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
        'color' => 'success',
        'value' => ['HISTORY',]
    ],
    [
        'name' => 'SCRAMBLE',
        'color' => 'danger',
        'value' => ['SCRAMBLE']
    ],
    [
        'name' => 'SAY / SAYTEAM',
        'color' => 'success',
        'value' => ['SAY','SAYTEAM']
    ],
    [
        'name' => 'SWITCH',
        'color' => 'success',
        'value' => ['SWITCH']
    ],
    [
        'name' => 'SWAPTEAMS',
        'color' => 'success',
        'value' => 'SWAPTEAMS'
    ],
    [
        'name' => 'FLY',
        'color' => 'success',
        'value' => ['FLY']
    ],
    [
        'name' => 'UNBAN',
        'color' => 'danger',
        'value' => ['UNBAN']
    ],
    [
        'name' => 'INIT',
        'color' => 'success',
        'value' => 'INIT'
    ],
    [
        'name' => 'RELOAD',
        'color' => 'success',
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
        'color' => 'success',
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
];

// width of page
$config['full_width'] = false;

// height of modal
$config['modal_height'] = '700px';

// Share on globals
$GLOBALS['config'] = $config;