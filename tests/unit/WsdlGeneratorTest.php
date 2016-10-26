<?php

namespace subdee\soapserver\tests;

use Codeception\TestCase\Test;
use subdee\soapserver\tests\unit\SoapController;
use subdee\soapserver\WsdlGenerator;

class WsdlGeneratorTest extends Test
{
	public function testGenerateWsdl()
	{
		$wsdlGenerator = new WsdlGenerator();
		$controller = new SoapController();
		$wsdl = $wsdlGenerator->generateWsdl(get_class($controller), 'http://test-url/');

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
