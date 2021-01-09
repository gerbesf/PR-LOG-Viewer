<?php

include "../config.php";
header('Content-Type: application/json');
if($GLOBALS['config']['auth_enabled']==false){
    echo json_encode([
        'status'=>true,
        'expiration'=> date('Y-m-d', strtotime(date('Y-m-d H:i:s'). ' + 1 days'))
    ]);
}else{
    $Session = new \App\Session();
    echo json_encode([
        'status'=>$Session->isLogged(  ),
        'expiration'=>$_SESSION['expires']
    ]);
}
