<?php

include "../config.php";
header('Content-Type: application/json');

$Session = new \App\Session();

if($config['require_login']==false){
    $startDate = time();
    echo json_encode([
        'status'=>true,
        'expiration'=>date('Y-m-d H:i:s', strtotime('+1 day', $startDate))
    ]);
}else{
    echo json_encode([
        'status'=>$Session->isLogged(),
        'expiration'=>$_SESSION['expires']
    ]);
}
