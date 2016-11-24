<?php
namespace subdee\soapserver\Validators;

/**
 * TODO Alias for IntegerType, I should handle this better..
 */
class NumberType extends IntegerType
{
    /** @inheritdoc */
    public function getName()
    {
        return 'integer';
    }
}