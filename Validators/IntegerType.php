<?php
namespace subdee\soapserver\Validators;

class IntegerType extends SimpleType
{

    /**
     * Generates a Integer wsdl array
     * @return array
     */
    public function generateSimpleType()
    {
        $simpleType = [];

        if (array_key_exists('min',$this->data['parameters'])) {
            $minInclusive = gmp_init($this->data['parameters']['min']);
            $simpleType['restriction']['minInclusive'] = gmp_strval($minInclusive);
        }
        if (array_key_exists('max',$this->data['parameters'])) {
            $maxInclusive = gmp_init($this->data['parameters']['max']);
            $simpleType['restriction']['maxInclusive'] = gmp_strval($maxInclusive);
        }
        $simpleType['restriction']['name'] = $this->getName();
        return $simpleType;
    }

    /**
     * Generates a domElement and inserts it into the given DomDocument
     * @param \DOMDocument $dom
     * @param string $fieldName
     * @return \DOMDocument $dom
     */
    public function generateXsd($dom, $fieldName)
    {
        $simpleTypeElement = $dom->createElement('xsd:simpleType');
        $simpleTypeElement->setAttribute('name', $fieldName);

        $restriction = $dom->createElement('xsd:restriction');
        $restriction->setAttribute('base', 'xsd:' . $this->getName());

        $simpleType = $this->generateSimpleType();

        if(array_key_exists('minInclusive', $simpleType['restriction'])) {
            $minInclusive = $dom->createElement('xsd:minInclusive');
            $minInclusive->setAttribute('value', $simpleType['restriction']['minInclusive']);
            $restriction->appendChild($minInclusive);
        }
        if(array_key_exists('maxInclusive', $simpleType['restriction'])) {
            $maxInclusive = $dom->createElement('xsd:maxInclusive');
            $maxInclusive->setAttribute('value', $simpleType['restriction']['maxInclusive']);
            $restriction->appendChild($maxInclusive);
        }

        $simpleTypeElement->appendChild($restriction);

        return $simpleTypeElement;
    }
}