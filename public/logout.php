<?php

include "../config.php";
session_start();
$_SESSION['user_id']=null;
$_SESSION['user_id']=null;
session_destroy();
return header('Location: index.php');