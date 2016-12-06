<?php
namespace subdee\soapserver\Validators;

/**
 * @description Validator for explicit Doubles
 * @package subdee\soapserver\Validators
 */
class DoubleType extends SimpleType
{

    /**
     * Generates a Integer wsdl array
     * @return array
     */
    public function generateSimpleType()
    {
        $simpleType = [];

        $fractionDigits = 0;

        if (array_key_exists('min', $this->data['parameters'])) {
            $minInclusive = $this->data['parameters']['min'];
            $simpleType['restriction']['minInclusive'] = $minInclusive;
            $simpleType['restriction']['fractionDigits'] = $this->numberOfDecimals($minInclusive);
        }
        if (array_key_exists('max', $this->data['parameters'])) {
            $maxInclusive = $this->data['parameters']['max'];
            $simpleType['restriction']['maxInclusive'] = $maxInclusive;
            $simpleType['restriction']['fractionDigits'] = max($fractionDigits, $this->numberOfDecimals($maxInclusive));
        }

        $simpleType['restriction']['name'] = $this->getName();


        return $simpleType;
    }

    /**
     * Generates a domElement and inserts it into the given DomDocument
     * @param \DOMDocument $dom
     * @param string $fieldName
     * @return \DOMElement $dom
     */
    public function generateXsd(\DOMDocument $dom, $fieldName)
    {
        $simpleTypeElement = $dom->createElement('xsd:simpleType');
        $simpleTypeElement->setAttribute('name', $fieldName);

        $restriction = $dom->createElement('xsd:restriction');
        $restriction->setAttribute('base', 'xsd:decimal');

        $simpleType = $this->generateSimpleType();

        if (array_key_exists('minInclusive', $simpleType['restriction'])) {
            $minInclusive = $dom->createElement('xsd:minInclusive');
            $minInclusive->setAttribute('value', $simpleType['restriction']['minInclusive']);
            $restriction->appendChild($minInclusive);

        }
        if (array_key_exists('maxInclusive', $simpleType['restriction'])) {
            $maxInclusive = $dom->createElement('xsd:maxInclusive');
            $maxInclusive->setAttribute('value', $simpleType['restriction']['maxInclusive']);
            $restriction->appendChild($maxInclusive);
        }

        if (array_key_exists('fractionDigits', $simpleType['restriction'])) {
            $fraction = $dom->createElement('xsd:fractionDigits');
            $fraction->setAttribute('value', $simpleType['restriction']['fractionDigits']);
            $restriction->appendChild($fraction);
        }
        $simpleTypeElement->appendChild($restriction);

        return $simpleTypeElement;
    }

    /**
     * Returns the number of decimals of a number
     * @param $value
     * @return bool|int
     */
    private function numberOfDecimals($value)
    {
        if (!is_string($value)) {
            $value = (string)$value;
        }
        if ((int)$value === $value) {
            return 0;
        } else if (!is_numeric($value)) {
            return false;
        }

        return strlen($value) - strrpos($value, '.') - 1;
    }
}