<?php

namespace classes;

use ipinfo\ipinfo\IPinfo;
use LucidFrame\Console\ConsoleTable;

class HttpCall
{
    private $client;
    private $ipAddress;
    private $details;
    private $table;

    public function __construct(IPinfo $client, string $ipAddress, ConsoleTable $table)
    {
        $this->client = $client;
        $this->ipAddress = $ipAddress;
        $this->table = $table;
        $this->details = $this->client->getDetails($this->ipAddress);
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function echoTable()
    {
        $arrays = [];
        foreach ($this->details as $key => $value) {
            if (!is_array($value)) {
                $arrays[] = [$key, $value] ;
            }
        }

        foreach ($arrays as $array){
            {
                $this->table->addRow($array);
            }
        }
        $this->table->display();
    }

    public function writeJson(){
        return json_encode($this->details);
    }

}