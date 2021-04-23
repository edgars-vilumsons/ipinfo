<?php

use ipinfo\ipinfo\IPinfo;

class HttpCall {
    private $client;
    private $ipAddress;
    private $details;

    public function __construct(IPinfo $client, String $ipAddress){
        $this->client = $client;
        $this->ipAddress = $ipAddress;
        $this->details = $this->client->getDetails($this->ipAddress);
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function jsonEncode(){
        $jsonData = json_encode($this->details);
        file_put_contents('test.json', $jsonData);
    }

    public function echoDetails(){
        foreach ($this->details as $key => $value) {
            //echo "$key => $value\n";
            if (!is_array($value))
            {
                echo $key ." => ". $value ."\r\n" ;
            }
            /*else
            {
                echo $key ." => array( \r\n";

                foreach ($value as $key2 => $value2)
                {
                    echo "\t". $key2 ." => ". $value2 ."\r\n";
                }

                echo ")";
            }*/
        }
    }
}