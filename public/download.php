<?php

include "../config.php";
header('Content-Type: application/json');

try{

    foreach($config['servers_list'] as $server_list){

        // Lock in active Server
        if($server_list['id']==$_GET['server_id']){

            saveLogFiles( $server_list );
            saveHashFiles( $server_list );
            saveServerFiles( $server_list );

            // registra o tempo
            $content = date('Y-m-d H:i:s');
            $fp = fopen( './logs/'.$server_list['local_name'].'.timestamp',"wb");
            fwrite($fp,$content);
            fclose($fp);

            echo json_encode([
                'success'=>true,
                'message'=>'Success on download',
            ]);

        }

    }

}catch ( Exception $exception ){
    echo json_encode([
        'success'=>false,
        'code'=>$exception->getCode(),
        'message'=>$exception->getMessage(),
    ]);
}


function saveLogFiles( $server ){

    // mater file
    $masterFile = file_get_contents( $server['ra_adminlog'] );

    // incremental file
    $getIncremental = '';
    if( $server['ra_adminlog_main'] ) {
        $getIncremental = @file_get_contents( $server['ra_adminlog_main'] );
    }

    // save file
    file_put_contents('logs/'.$server['local_name'],$masterFile.$getIncremental);

}


function saveHashFiles( $server ){

    // mater file
    $masterFile = file_get_contents( $server['cdhash'] );

    // incremental file
    $getIncremental = '';
    if( $server['cdhash_main'] ) {
        $getIncremental = @file_get_contents( $server['cdhash_main'] );
    }

    // save file
    file_put_contents('logs/hash_'.$server['local_name'],$masterFile.$getIncremental);

}


function saveServerFiles( $server ){

    // banlist
    $banlist = file_get_contents( $server['banlist'] );
    $lines = str_replace(['admin.addKeyToBanList '],'',$banlist);
    file_put_contents('logs/banlist_'.$server['local_name'],$lines);

    // whitelist
    $whitelist = file_get_contents( $server['whitelist'] );
    file_put_contents('logs/whitelist_'.$server['local_name'],$whitelist);

}




