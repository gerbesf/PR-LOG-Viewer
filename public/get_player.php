<?php

session_start();
include "../config.php";
header('Content-Type: application/json');

// set command name on result
foreach($config['server_commands'] as $server_commands){
    if($server_commands['value']==$_GET['command']){
        $command_result = $server_commands['name'];
        $command_color = $server_commands['color'];
    }
}

// list servers
foreach($config['servers_list'] as $server_list){

    // Lock in active Server
    if($server_list['id']==$_GET['server_id']) {

        $hash = [];
        $results = [];
        $search = strtolower($_GET['search']);
        $file = file(__DIR__ . '/logs/hash_' . $server_list['local_name']);
        foreach($file as $line) {

            $line_original = $line;
            $line = trim(strtolower($line));
            $pattern = "/^.*$search.*\$/m";
            if (strpos($line, $search) !== false) {
                $hash[] = explodeLine($line_original);
            }

        }

        $g = $_GET['group_by'];
        if($g=='data'){
            $g = $_GET['group_by'].'_index';
        }

        foreach($hash as $item){
            $results[$item[$g]][] = $item;
        }

        echo json_encode($results);
    }
}

function explodeLine($line){

    $data = substr($line,1,16).':00';
    $hash = substr($line,19,32);
    $nick_ip = explode('  ',substr($line,52,100));

    return [
        'data_index'=>date($GLOBALS['config']['date_format'],strtotime($data)),
        'data'=>date($GLOBALS['config']['date_format'].' '.$GLOBALS['config']['hour_format'],strtotime($data)),
        'hash'=>$hash,
        'nick'=>$nick_ip[0],
        'ip'=>$nick_ip[1],
    ];

}
