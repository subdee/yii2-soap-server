<?php
namespace subdee\soapserver\Validators;

/**
 * Empty, we can't tell the wsdl user what to do here, so we ignore this model validation type
 */
class TrimType extends SimpleType
{
    /**
     * returns the data used in the creation of the wsdl
     * @return array
     */
    public function generateSimpleType()
    {
        return null;
    }
}