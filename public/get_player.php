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

        $results = [];
        $search = strtolower($_GET['search']);
        $file = file(__DIR__ . '/logs/hash_' . $server_list['local_name']);
        foreach($file as $line) {
            $line = trim($line);

            $pattern = "/^.*$search.*\$/m";
            $line_original = $line;
            if(preg_match_all($pattern, strtolower($line), $matches)){
                 implode("\n", $matches[0]);
                $results[]['line'] = implode("\n", $matches[0]);
            }

        }

        echo json_encode($results);



    }
}
