<?php

use classes\HttpCall;
use classes\Validator;
use ipinfo\ipinfo\IPinfo;
use LucidFrame\Console\ConsoleTable;
use EnricoStahn\JsonAssert\Assert as JsonAssert;

class SampleTest extends \PHPUnit\Framework\TestCase
{
    use JsonAssert;

    protected $ipInfo;
    protected $table;
    protected $httpCall;

    protected function setUp(): void
    {
        $this->ipInfo = new IPinfo();
        $this->table = new ConsoleTable();
        $this->httpCall = new HttpCall($this->ipInfo, '1.1.1.1', $this->table);
    }

    public function testTrueAssertsToTrue()
    {
        $this->assertTrue(true);
    }

    public function testHttpCallGetDetails()
    {
        $obj = $this->httpCall->getDetails();

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
        $arr = $this->httpCall->prepareDetailsForTable();

        $this->assertIsArray($arr);
        $this->assertCount(2, $arr[0], $message = "Array 0 index doesn't contains 2 elements");
    }

    public function testJsonDocumentIsValid()
    {
        $json = json_decode($this->httpCall->encodeJson());

        $this->assertJsonMatchesSchema($json, './forTest.json');
    }

    public function testValidValidatorValidateIp()
    {
        $bool = Validator::validateIp('1.1.1.1');
        $this->assertTrue($bool, $message = "Must return true if valid ip");
    }
}