<?php

session_start();
include "../config.php";
//header('Content-Type: application/json');

file_put_contents("Tmpfile.zip", fopen("http://someurl/file.zip", 'r'));


foreach($config['servers_list'] as $server_list){

    // Lock in active Server
    if($server_list['id']==$_GET['server_id']){
        
        $curlData = file_get_contents( $server_list['path'] );
        
        file_put_contents('logs/'.$server_list['local_name'],$curlData);
        
        echo 'Saved';
        
    }
    
}
