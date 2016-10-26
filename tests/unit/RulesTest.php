<?php
namespace subdee\soapserver\tests;

use Codeception\TestCase\Test;
use subdee\soapserver\WsdlGenerator;

/**
 * Class RulesTest
 * @package subdee\soapserver\tests
 */
class RulesTest extends Test
{
    public function testSimple()
    {
        $wsdlGenerator = new WsdlGenerator();

        $type = 'subdee\soapserver\tests\models\RulesTestModel';
        $validators = $wsdlGenerator->readValidators(new \ReflectionClass($type), $type);

        $this->assertArrayHasKey('integerValue',$validators);
        $this->assertArrayHasKey('stringValue', $validators);

        $this->assertArrayHasKey('validator',$validators['integerValue'][0]);

        $this->assertEquals('trim',$validators['regExpValue'][0]['validator']);

        $this->assertEquals('/[a-z]*/i',$validators['regExpValue'][1]['parameters']['pattern']);

        $this->assertNotContains('InvalidValidator',$validators['regExpValue']);
    }
}