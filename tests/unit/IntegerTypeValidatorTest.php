<?php
namespace subdee\soapserver\tests;

use Codeception\TestCase\Test;
use subdee\soapserver\Validators\IntegerType;

class IntegerTypeValidatorTest extends Test
{
    /** @var \subdee\soapserver\Validators\SimpleType */
    private $validator;

    public function setUp()
    {
        $data = ['parameters' =>
            [
                'min' => 5,
                'max' => 10
            ]
        ];
        $this->validator = new IntegerType($data);
        return parent::setUp();
    }

    public function testGeneratedName()
    {
        $this->assertEquals('integer',$this->validator->getName());
    }


    public function testVeryLargeNumber()
    {
        $data = ['parameters' =>
            [
                'min' => 5,
                'max' => '99999999999999999999'
            ]
        ];
        $this->validator = new IntegerType($data);
        $simpleTypeData = $this->validator->generateSimpleType();
        $this->assertEquals('99999999999999999999',$simpleTypeData['restriction']['maxInclusive']);
    }

    public function testGeneratedSimpleTypeData()
    {
        $simpleTypeData = $this->validator->generateSimpleType();
        $this->assertInstanceOf('subdee\soapserver\Validators\IntegerType',$this->validator);
        $this->assertArrayHasKey('restriction', $simpleTypeData);
        $this->assertArrayHasKey('minInclusive', $simpleTypeData['restriction']);
    }
}
