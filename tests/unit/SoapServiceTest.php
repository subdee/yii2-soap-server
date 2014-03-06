<?php

namespace subdee\soapserver\tests;

use Codeception\TestCase\Test;
use subdee\soapserver\tests\unit\SoapController;
use subdee\soapserver\SoapService;

class SoapServiceTest extends Test
{
   /**
    * @var \CodeNinja
    */
    protected $codeNinja;

	protected $xml = '';

    protected function _before()
    {

    }

    protected function _after()
    {
    }

    public function testGenerateWsdl()
    {
		$controller = new SoapController();
		$soapService = new SoapService($controller, 'http://wsdl-url/', 'http://test-url/');
		$wsdl = $soapService->generateWsdl();

		$xml = simplexml_load_string($wsdl);
		$this->assertTrue($xml instanceOf \SimpleXMLElement);
		$this->assertTrue((string) $xml->getName() === 'definitions');

		$operation = $xml->xpath('//wsdl:operation[@name="getHello"]');
		$this->assertTrue($operation[0] instanceof \SimpleXMLElement);

		$address = $xml->xpath('//soap:address');
		$location = (string) $address[0]->attributes()->location;
		$this->assertEquals('http://test-url/', $location);
    }

}
