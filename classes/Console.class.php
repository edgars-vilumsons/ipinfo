<?php

namespace classes;

use classes\Validator;
use ipinfo\ipinfo\IPinfo;
use LucidFrame\Console\ConsoleTable;
use classes\HttpCall;

class IpInfoConsole
{
    public static function start($argv)
    {
        if ((count($argv)) == 1) {
            echo "No arguments passed!";
            return;
        }

        if ((count($argv)) > 3) {
            echo "Too many arguments";
            return;
        }

        if (Validator::validateIp($argv[1])) {

            $ipInfo = new IPinfo();
            $table = new ConsoleTable();
            $httpCall = new HttpCall($ipInfo, $argv[1], $table);

            if ((count($argv)) == 2) {

                $httpCall->prepareDetailsForTable();
                $httpCall->echoTable();

            }

            if ((count($argv)) == 3) {

                if (Validator::validatePathName($argv[2])) {

                    $dir = $argv[2];
                    if (!file_exists($dir)) {
                        mkdir($dir, 0744);
                    }
                    file_put_contents($dir . '/ipInfo.json', $httpCall->encodeJson());

                } else {
                    echo "Path name contains at least one illegal character!";
                }
            }
        } else {
            echo "Ip address not valid!";
        }
    }
}
