<?php
declare(strict_types = 1);


namespace subdee\soapserver\Validators;


class MatchType extends SimpleType
{

    /**
     * returns the data used in the creation of the wsdl
     * @return array
     */
    public function generateSimpleType()
    {
        if(array_key_exists('pattern',$this->data['parameters']))
        {
            preg_match('/^\/(.*)\/.*/',$this->data['parameters']['pattern'], $matches);
            $simpleType['restriction']['pattern'] = $matches[1];
        }

        $simpleType['restriction']['name'] = $this->getName();

        return $simpleType;
    }
}