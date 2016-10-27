<?php
namespace subdee\soapserver\Validators;

class TokenType extends SimpleType
{
    /**
     * returns the data used in the creation of the wsdl
     * @return array
     */
    public function generateSimpleType()
    {
        // FIXME we don't support not, strict and allowArray
        $simpleType = [];

        $this->data['restriction']['name'] = 'token';
        if(array_key_exists('range',$this->data['parameters'])){
            foreach($this->data['parameters']['range'] as $enumeration)
            {
                $simpleType['restriction']['enumeration'][] = $enumeration;
            }
        }

        $simpleType['restriction']['name'] = $this->getName();
        return $simpleType;
    }
}