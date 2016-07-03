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

        // Execute GET
        $curl = file_get_contents( $server_list['path'] );
        $command_search = $_GET['command'];

        $res = [];

        $file = explode ( '
', (mb_convert_encoding($curl, 'HTML-ENTITIES', "UTF-8")) );
        $index=0;
        foreach ( $file as $linha ) {
            $index++;
            $line = explode('performed by', $linha);
            $line_command = trim(substr($line [0], 21));
            $data = trim(substr($line [0], 0, 20));
            $data_format = date_create(str_replace("'", '', $data));
            $message_e = explode("': ", $line[1]);
            if ($line_command == $command_search) {
                $res[] = [
                    'date' => date_format($data_format, $config['date_format']),
                    'hour' => date_format($data_format, $config['hour_format']),
                    'command' => $command_result,
                    'color' => $command_color,
                    'mess'=>$linha,
                    'players' => substr($message_e[0], 2),
                    'content' => $message_e[1]
                ];
            }

        }

        rsort($res);
        echo json_encode([
            'server_log'=>$res
        ]);

    }
}
