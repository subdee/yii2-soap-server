<?php
namespace subdee\soapserver\Validators;

/**
 * Simple version of https://www.w3.org/TR/xmlschema-2/#isoformats
 */
class DateType extends MatchType
{
    /**
     * returns the data used in the creation of the wsdl
     * @return array
     */
    public function generateSimpleType()
    {
        if(array_key_exists('format',$this->data['parameters']))
        {
            $simpleType['restriction']['pattern'] = strtoupper($this->data['parameters']['format']);
        }
        else
        {
            $simpleType['restriction']['pattern'] = 'YYYYMMDD';
        }

        $simpleType['restriction']['name'] = $this->getName();

        return $simpleType;
    }
}