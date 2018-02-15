<?php

include "../config.php";
header('Content-Type: application/json');

$results = [];
// list servers
foreach($config['servers_list'] as $server_list){

    $servers_ids = explode(',',substr($_GET['server_id'],0,-1));

    // Lock in active Server
    if( in_array($server_list['id'],$servers_ids) ){

        $hash = [];
        $search = strtolower($_GET['search']);
        $file = file(__DIR__ . '/logs/hash_' . $server_list['local_name']);

        $list = array_reverse($file);
        foreach($list as $line) {

            $line_original = $line;
            $line = trim(strtolower($line));
            $pattern = "/^.*$search.*\$/m";
            if (strpos($line, $search) !== false) {
                $hash[] = explodeLine($line_original);
            }

        }

        $g = $_GET['group_by'];
        if($g=='data'){
            $g = $_GET['group_by'].'_index';
        }

        foreach($hash as $item){

            $item['server']=$server_list['name'];

            if($_GET['hide']=='true'){
                $unique_index = md5($item['hash'].$item['nick'].$item['ip']);
                $results[$item[$g]][$unique_index] = $item;
            }else{
                $results[$item[$g]][] = $item;
            }

            $unique_index = md5($item['hash'].$item['nick'].$item['ip']);
            $results[$item[$g]][$unique_index] = $item;
        }



    }
}

echo json_encode($results);

function explodeLine($line){

    $data = substr($line,1,16).':00';
    $hash = substr($line,19,32);
    $nick_ip = explode('  ',substr($line,52,100));

    $ip = $nick_ip[1];
    if($GLOBALS['config']['hide_ips']==true){
        $eIp = explode('.',$nick_ip[1]);
        $ip = $eIp[0].'.'.$eIp['1'].'.'.str_repeat('0',strlen($eIp['2'])).'.'.str_repeat('0',strlen($eIp['2']));
    }

    return [
        'data_index'=>date($GLOBALS['config']['date_format'],strtotime($data)),
        'data'=>date($GLOBALS['config']['date_format'].' '.$GLOBALS['config']['hour_format'],strtotime($data)),
        'hash'=>$hash,
        'nick'=>$nick_ip[0],
        'ip'=>$ip,
    ];

}
