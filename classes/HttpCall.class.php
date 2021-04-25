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
    private $prepArrays;

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

    public function prepareDetailsForTable()
    {
        foreach ($this->details as $key => $value) {
            if (!is_array($value)) {
                $this->prepArrays[] = [$key, $value];
            }
        }
        return $this->prepArrays;
    }

    public function echoTable()
    {
        /*
        $arrays = [];
        foreach ($this->details as $key => $value) {
            if (!is_array($value)) {
                $arrays[] = [$key, $value];
            }
        }
        */
        foreach ($this->prepArrays as $array) {
            {
                $this->table->addRow($array);
            }
        }

        $this->table->display();
    }

    public function writeJson()
    {
        return json_encode($this->details);
    }

}