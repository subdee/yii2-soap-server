<?php
namespace subdee\soapserver\Validators;

class StringType extends SimpleType
{
    /**
     * returns the data used in the creation of the wsdl
     * @return array
     */
    public function generateSimpleType()
    {
        $simpleType = [];

        if(array_key_exists('parameters',$this->data) && is_array($this->data['parameters'])) {
            $this->data['restriction']['pattern']  = '{' . implode(',',$this->data['parameters']['length']) . '}';
        }

        $simpleType['restriction']['name'] = $this->getName();
        return $simpleType;
    }
}