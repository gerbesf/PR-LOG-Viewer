<?php

include "../config.php";
header('Content-Type: application/json');

$res = [];
// list servers
foreach($config['servers_list'] as $server_list){


    $servers_ids = explode(',',substr($_GET['server_id'],0,-1));

    // Lock in active Server
    if( in_array($server_list['id'],$servers_ids) ){

        // Execute Request on Server
        #$curl = file_get_contents( $server_list['path'] );

        // Read on server
        $curl = file_get_contents( 'logs/'.$server_list['local_name']);

       # $command_search = $_GET['command'];
       # $checkMultiples = explode(',',$command_search);

        $file = explode ( '
', (mb_convert_encoding($curl, 'HTML-ENTITIES', "UTF-8")) );
        $index=0;
        foreach ( $file as $linha ) {
            
        
            $index++;
            $line = explode('performed by', $linha);
            $line_command = trim(substr($line [0], 20));
            $data = trim(substr($line [0], 1, 16));
            $data_format = date_create(str_replace("'", '', $data));
            
            $message_e = explode("': ", @$line[1]);

            $search = $_GET['search_all'];
            $pattern = "/^.*".$search.".*\$/m";
            if (strpos(strtolower($linha), strtolower($search)) !== false) {
                $res[] = [
                    'server'=>$server_list['name'],
                    'date' => date_format($data_format, $config['date_format']),
                    'hour' => date_format($data_format, $config['hour_format']),
                    'command' => $line_command,
                    'color' => 'primary',
                    'mess'=>$linha,
                    'players' => substr($message_e[0], 2),
                    'content' => $message_e[1]
                ];
            }



        }

    }



}

echo json_encode([
    'server_log'=>array_reverse($res)
]);