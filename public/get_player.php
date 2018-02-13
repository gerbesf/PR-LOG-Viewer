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
            $line = trim($line);

            $pattern = "/^.*$search.*\$/m";
            $line_original = $line;
            if(preg_match_all($pattern, strtolower($line), $matches)){
                 implode("\n", $matches[0]);
                $hash[] = explodeLine(implode("\n", $matches[0]));
                #$results[]['line'] = $this->explodeLine(implode("\n", $matches[0]));
            }

        }

        foreach($hash as $item){
            $results[$item[$_GET['group_by']]][] = $item;
        }

        echo json_encode($results);
    }
}

function explodeLine($line){

    $data = substr($line,1,16).':00';
    $hash = substr($line,19,32);
    $nick_ip = explode('  ',substr($line,52,100));

    return [
        'data'=>date($GLOBALS['config']['date_format'].' '.$GLOBALS['config']['hour_format'],strtotime($data)),
        'hash'=>$hash,
        'nick'=>strtoupper($nick_ip[0]),
        'ip'=>$nick_ip[1],
       # 'line'=>$line
    ];

}
