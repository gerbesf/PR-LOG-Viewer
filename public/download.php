<?php

session_start();
include "../config.php";
//header('Content-Type: application/json');


foreach($config['servers_list'] as $server_list){

    // Lock in active Server
    if($server_list['id']==$_GET['server_id']){
        
        $curlData = file_get_contents( $server_list['path'] );
        
        file_put_contents('logs/'.$server_list['local_name'],$curlData);
        
        echo 'Saved';

        $content = date('Y-m-d H:i:s');
        $fp = fopen( getenv("DOCUMENT_ROOT") . 'logs/'.$server_list['local_name'].'.timestamp',"wb");
        fwrite($fp,$content);
        fclose($fp);
        
    }
    
}
/*
 *


 */