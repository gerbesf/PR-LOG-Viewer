<?php
include "../config.php";
header('Content-Type: application/json');

// set command name on result
foreach($GLOBALS['config']['server_commands'] as $server_commands){
    if($server_commands['value']==$_GET['command']){
        $command_result = $server_commands['name'];
        $command_color = $server_commands['color'];
    }
}

$res = [];
// list servers
foreach($GLOBALS['config']['servers_list'] as $server_list){


    $servers_ids = explode(',',substr($_GET['server_id'],0,-1));

    // Lock in active Server
    if( in_array($server_list['id'],$servers_ids) ){

        // Execute Request on Server
        #$curl = file_get_contents( $server_list['path'] );

        // Read on server
        $curl = file_get_contents( 'logs/'.$server_list['local_name']);
                
        $command_search = $_GET['command'];
        $checkMultiples = explode(',',$command_search);

        if(!isset($command_color)){
            $command_color = 'primary';
        }


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
            if($checkMultiples>=2){

                if ( in_array($line_command,$checkMultiples)) {

                    $res[] = [
                        'server'=>$server_list['name'],
                        'date' => date_format($data_format, $config['date_format']),
                        'hour' => date_format($data_format, $config['hour_format']),
                        'command' => $line_command,
                        'color' => $command_color,
                        'mess'=>$linha,
                        'players' => substr($message_e[0], 2),
                        'content' => $message_e[1]
                    ];
                }

            }else{

                if ($line_command == $command_search or $command_search=='ALL') {

                    $res[] = [
                        'server'=>$server_list['name'],
                        'date' => date_format($data_format, $config['date_format']),
                        'hour' => date_format($data_format, $config['hour_format']),
                        'command' => $line_command,
                        'color' => $command_color,
                        'mess'=>$linha,
                        'players' => substr($message_e[0], 2),
                        'content' => $message_e[1]
                    ];
                }

            }

        }

    }

    #$res = array_reverse($res);


   // krsort($res);

}

echo json_encode([
    'server_log'=>array_reverse($res)
]);