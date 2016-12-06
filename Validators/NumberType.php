<?php
namespace subdee\soapserver\Validators;

/**
 * @description Number validator
 * @package subdee\soapserver\Validators
 */
class NumberType extends SimpleType
{
    /** @var IntegerType|DoubleType  */
    private $validator;

    /** @noinspection MagicMethodsValidityInspection */
    /** @noinspection PhpMissingParentConstructorInspection */

    /**
     * NumberType constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        if(array_key_exists('integerOnly', $data) && $data['integerOnly'] === true){
            $this->validator = new IntegerType($data);
        }
        else {
            $this->validator = new DoubleType($data);
        }
    }

    /**
     * returns the data used in the creation of the wsdl
     * @return array
     */
    public function generateSimpleType()
    {
        return $this->validator->generateSimpleType();
    }

    /**
     * Generates a domElement and inserts it into the given DomDocument
     * @param \DOMDocument $dom
     * @param string $fieldName Which field are we building an XSD
     * @return \DOMElement $dom
     */
    public function generateXsd(\DOMDocument $dom, $fieldName)
    {
        return $this->validator->generateXsd($dom, $fieldName);
    }

    /** @inheritdoc */
    public function getName()
    {
        return $this->validator->getName();
    }
}