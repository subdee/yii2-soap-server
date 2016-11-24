<?php
declare(strict_types = 1);


namespace subdee\soapserver\Validators;

/**
 * @description Required has no meaning for us, but we must implement it otherwise the code will fail because it can't find the simpleType (which we have implemented all)
 */
class RequiredType extends TrimType
{

}