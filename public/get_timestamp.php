<?php
include "../config.php";
header('Content-Type: application/json');

// list servers
foreach($GLOBALS['config']['servers_list'] as $server_list){

    // Lock in active Server
    if($server_list['id']==$_GET['server_id']){

        if( is_file( __DIR__.'/logs/'.$server_list['local_name'].'.timestamp' )) {
            echo json_encode([
                'timestamp'=> date($config['date_format'].' '.$config['hour_format'],strtotime( file_get_contents(__DIR__.'/logs/'.$server_list['local_name'].'.timestamp') ))
            ]);
        } else {
            echo json_encode([
                'timestamp'=> ''
            ]);
        }

    }
}
