<?php

namespace classes;

use ipinfo\ipinfo\IPinfo;
use LucidFrame\Console\ConsoleTable;
use classes\HttpCall;

class IpInfoConsole
{

    public static function start($argv)
    {
        $ipInfo = new IPinfo();
        $table = new ConsoleTable();
        $httpCall = new HttpCall($ipInfo, $argv[1], $table);

        if ((count($argv)) == 2) {

            $httpCall->prepareDetailsForTable();
            $httpCall->echoTable();

        }

        if ((count($argv)) == 3) {

            $dir = $argv[2];
            if (!file_exists($dir)) {
                mkdir($dir, 0744);
            }
            file_put_contents($dir . '/ipInfo.json', $httpCall->encodeJson());

        }
    }

}
