<?php

namespace subdee\soapserver\tests;

use Codeception\TestCase\Test;
use subdee\soapserver\tests\Controllers\SoapController;
use subdee\soapserver\WsdlGenerator;

class WsdlGeneratorTest extends Test
{
	public function testGenerateWsdl()
	{
		$wsdlGenerator = new WsdlGenerator();
		$controller = new SoapController();
		$wsdl = $wsdlGenerator->generateWsdl(get_class($controller), 'http://test-url/');

		$xml = simplexml_load_string($wsdl);
		$this->assertInstanceOf(\SimpleXMLElement::class, $xml);
		$this->assertSame((string) $xml->getName(), 'definitions');

		$operation = $xml->xpath('//wsdl:operation[@name="getHello"]');
		$this->assertInstanceOf(\SimpleXMLElement::class, $operation[0]);

		$address = $xml->xpath('//soap:address');
		$location = (string) $address[0]->attributes()->location;
		$this->assertEquals('http://test-url/', $location);

	}

}
