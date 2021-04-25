<?php

use classes\HttpCall;
use ipinfo\ipinfo\IPinfo;
use LucidFrame\Console\ConsoleTable;
use EnricoStahn\JsonAssert\Assert as JsonAssert;

class SampleTest extends \PHPUnit\Framework\TestCase
{

    use JsonAssert;

    public function testTrueAssertsToTrue()
    {
        $this->assertTrue(true);
    }

    public function testHttpCallGetDetails()
    {
        $ipInfo = new IPinfo();
        $table = new ConsoleTable();
        $httpCall = new HttpCall($ipInfo, '1.1.1.1', $table);
        $obj = $httpCall->getDetails();

        $this->assertIsObject($obj);
        $this->assertObjectHasAttribute('ip', $obj);
        $this->assertObjectHasAttribute('hostname', $obj);
        $this->assertObjectHasAttribute('city', $obj);
        $this->assertObjectHasAttribute('region', $obj);
        $this->assertObjectHasAttribute('country', $obj);
        $this->assertObjectHasAttribute('loc', $obj);
        $this->assertObjectHasAttribute('org', $obj);
        $this->assertObjectHasAttribute('postal', $obj);
        $this->assertObjectHasAttribute('timezone', $obj);
        $this->assertObjectHasAttribute('readme', $obj);
        $this->assertObjectHasAttribute('country_name', $obj);
        $this->assertObjectHasAttribute('latitude', $obj);
        $this->assertObjectHasAttribute('longitude', $obj);
    }

    public function testPrepareDetailsForTable()
    {
        $ipInfo = new IPinfo();
        $table = new ConsoleTable();
        $httpCall = new HttpCall($ipInfo, '1.1.1.1', $table);
        $arr = $httpCall->prepareDetailsForTable();

        $this->assertIsArray($arr);
        $this->assertCount(2,$arr[0], $message = "Array 0 index doesn't contains 2 elements");
    }

    public function testJsonDocumentIsValid()
    {
        $ipInfo = new IPinfo();
        $table = new ConsoleTable();
        $httpCall = new HttpCall($ipInfo, '1.1.1.1', $table);
        $json = json_decode($httpCall->encodeJson());
        
        $this->assertJsonMatchesSchema($json, './forTest.json');


    }

}