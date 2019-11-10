<?php

include "../config.php";
header('Content-Type: application/json');

$Session = new \App\Session();
echo json_encode([
    'status'=>$Session->isLogged(),
    'expiration'=>$_SESSION['expires']
]);