<?php
session_start();
require "app/Session.php";

/* ----------- APP ---------- */
$config['app_name'] = 'PR LOG Viewer';
$config['expiration_time'] = '1 minute'; // 1 hour, 30 days, 10 seconds

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

    // Administration Log Files
    'ra_adminlog' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog.txt',
    'ra_adminlog_main' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog_main.txt',

    // Players Hash Files
    'cdhash' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash.txt',
    'cdhash_main' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash_main.txt',

    // Server Files
    'whitelist' => 'http://sposerver.divsul.com:666/PRServer/logs/whitelist.txt',
    'banlist' => 'http://sposerver.divsul.com:666/PRServer/logs/banlist.con',

    'local_name' => 'divsul_bra.txt', // file name for this server
];

// Example second server
/*
$config['servers_list'][] = [
    'id' => 2, // keep the sequential order
    'name' => 'DIVSUL USA', // server name

    'ra_adminlog' => 'http://miaserver.divsul.com:666/PRServer/logs/ra_adminlog.txt',
    'ra_adminlog_main' => 'http://miaserver.divsul.com:666/PRServer/logs/ra_adminlog_main.txt',

    // Players Hash Files
    'cdhash' => 'http://miaserver.divsul.com:666/PRServer/logs/cdhash.txt',
    'cdhash_main' => 'http://miaserver.divsul.com:666/PRServer/logs/cdhash_main.txt',

    // Server Files
    'whitelist' => 'http://miaserver.divsul.com:666/PRServer/logs/whitelist.txt',
    'banlist' => 'http://miaserver.divsul.com:666/PRServer/logs/banlist.con',

    'local_name' => 'divsul_usa.txt', // file name for this server
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
        'name' => 'RUNNEXT',
        'color' => 'danger',
        'value' => ['RUNNEXT']
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