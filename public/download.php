<?php

include "../config.php";

foreach($config['servers_list'] as $server_list){

    // Lock in active Server
    if($server_list['id']==$_GET['server_id']){

        // download full log
        $curlData = file_get_contents( $server_list['path'] );

        // download active log
        $curlDataActiveServer = '';
        if( $server_list['active_log'] ) {
            $curlDataActiveServer = file_get_contents( $server_list['active_log'] );
        }

        // save active log
        file_put_contents('logs/'.$server_list['local_name'],$curlData.$curlDataActiveServer);

        // download full hash players
        $curlDataHash = file_get_contents( $server_list['path_hash'] );

        // download active hash players
        $curlDataActiveServerHash = '';
        if( $server_list['hash_active_log'] ) {
            $curlDataActiveServerHash = file_get_contents( $server_list['hash_active_log'] );
        }

        // save active log
        file_put_contents('logs/hash_'.$server_list['local_name'],$curlDataHash.$curlDataActiveServerHash);

        echo 'Saved';

        $content = date('Y-m-d H:i:s');
        $fp = fopen( './logs/'.$server_list['local_name'].'.timestamp',"wb");
        fwrite($fp,$content);
        fclose($fp);
        
    }
    
}