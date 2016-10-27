<?php

namespace subdee\soapserver\tests;

use Codeception\TestCase\Test;
use subdee\soapserver\tests\Controllers\SoapController;
use subdee\soapserver\SoapService;

class SoapServiceTest extends Test
{
    public function testGenerateWsdl()
    {
		$controller = new SoapController();
		$soapService = new SoapService($controller, 'http://wsdl-url/', 'http://test-url/');
		$wsdl = $soapService->generateWsdl();

		$xml = simplexml_load_string($wsdl);
        $this->assertTrue($xml instanceOf \SimpleXMLElement);
		$this->assertSame((string) $xml->getName(), 'definitions');

		$operation = $xml->xpath('//wsdl:operation[@name="getHello"]');
        $this->assertTrue($xml instanceOf \SimpleXMLElement);

		$address = $xml->xpath('//soap:address');
		$location = (string) $address[0]->attributes()->location;
		$this->assertEquals('http://test-url/', $location);
    }

}
