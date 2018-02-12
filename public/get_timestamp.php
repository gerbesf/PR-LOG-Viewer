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
    if($server_list['id']==$_GET['server_id']){

        // Execute Request on Server
        $curl = file_get_contents( $server_list['path'] );

        echo json_encode([
            'timestamp'=> date($config['date_format'].' '.$config['hour_format'],strtotime( file_get_contents(__DIR__.'/logs/'.$server_list['local_name'].'.timestamp') ))
        ]);

    }
}
