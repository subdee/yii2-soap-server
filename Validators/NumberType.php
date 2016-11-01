<?php
namespace subdee\soapserver\Validators;

/**
 * Alias for IntegerType, I should handle this better..
 */
class NumberType extends IntegerType
{
    public function getName()
    {
        return 'integer';
    }
}