<?php
namespace subdee\soapserver\Validators;

class IntegerType extends SimpleType
{

    /**
     * Generates a Integer wsdl array
     * @return array
     */
    public function generateSimpleType()
    {
        $simpleType = [];

        if (array_key_exists('min',$this->data['parameters'])) {
            $simpleType['restriction']['minInclusive'] = $this->data['parameters']['min'];
        }
        if (array_key_exists('max',$this->data['parameters'])) {
            $simpleType['restriction']['maxInclusive'] = $this->data['parameters']['max'];
        }
        $simpleType['restriction']['name'] = $this->getName();
        return $simpleType;
    }
}