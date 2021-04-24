<?php
//185.154.220.186
require 'vendor/autoload.php';
include 'includes/autoloader.inc.php';
use ipinfo\ipinfo\IPinfo;
use LucidFrame\Console\ConsoleTable;



if ((count($argv)) == 2) {

$ipInfo = new IPinfo();
$table = new ConsoleTable();
$httpCall = new HttpCall($ipInfo, $argv[1], $table);
$httpCall->echoTable();

}

if ((count($argv)) == 3) {
    
}
