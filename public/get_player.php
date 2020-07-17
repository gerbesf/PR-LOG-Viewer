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

    $params_line = explode("\t",$line);

    $data = substr($params_line[0],1,16).':00';
    $hash = $params_line[1];
    $steam_level = $params_line[2];
    $nickname = $params_line[3];
    $entity_date = $params_line[4];
    $ip = $params_line[5];
    $tags = array_filter(explode(')',str_replace('(','',trim($params_line[6]))));

    return [
        'data_index'=>date($GLOBALS['config']['date_format'],strtotime($data)),
        'data'=>date($GLOBALS['config']['date_format'].' '.$GLOBALS['config']['hour_format'],strtotime($data)),
        'hash'=>$hash,
        'nick'=>$nickname,
        'ip'=>$ip,
        'tags'=>$tags,
        'steam_level'=>$steam_level,
    ];

}
