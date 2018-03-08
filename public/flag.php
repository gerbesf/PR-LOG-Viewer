<?php

$json = json_decode(file_get_contents('https://freegeoip.net/json/'.$_GET['ip']));
header('Content-type: image/jpeg');
echo ( file_get_contents('http://www.geonames.org/flags/x/'.strtolower($json->country_code).'.gif') );