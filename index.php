<?php

require 'vendor/autoload.php';
include 'includes/autoloader.inc.php';
use ipinfo\ipinfo\IPinfo;


/*
$exampleIp = '185.154.220.186';
$client = new IPinfo();
$ip_address = $exampleIp;
$details = $client->getDetails($ip_address);
var_dump($details);
*/

$ipInfo = new IPinfo();
$table = new \LucidFrame\Console\ConsoleTable();
$httpCall = new HttpCall($ipInfo, '185.154.220.186', $table);
//var_dump($httpCall->getDetails());
//$httpCall->jsonEncode();
//$httpCall->echoDetails();
$httpCall->echoTable();