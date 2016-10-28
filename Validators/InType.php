<?php
namespace subdee\soapserver\Validators;

/**
 * The same as tokentype as far as wsdl is concerned
 */
class InType extends TokenType
{
    public function getName()
    {
        return 'token';
    }
}