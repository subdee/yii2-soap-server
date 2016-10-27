<?php
declare(strict_types = 1);


namespace subdee\soapserver\Validators;


class MatchType extends SimpleType
{

    /**
     * returns the data used in the creation of the wsdl
     * @return array
     */
    public function generateSimpleType()
    {
        if(array_key_exists('pattern',$this->data['parameters']))
        {
            preg_match('/^\/(.*)\/.*/',$this->data['parameters']['pattern'], $matches);
            $simpleType['restriction']['pattern'] = $matches[1];
        }

        $simpleType['restriction']['name'] = $this->getName();

        return $simpleType;
    }

    /**
     * Generates a domElement and inserts it into the given DomDocument
     * @param \DOMDocument $dom
     * @param string $fieldName Which field are we building an XSD for
     * @return \DOMDocument $dom
     */
    public function generateXsd($dom, $fieldName)
    {
        $simpleTypeElement = $dom->createElement('xsd:simpleType');
        $simpleTypeElement->setAttribute('name', $fieldName);

        $restriction = $dom->createElement('xsd:restriction');
        $restriction->setAttribute('base', 'xsd:' . $this->getName());

        $simpleType = $this->generateSimpleType();

        if (array_key_exists('enumeration', $simpleType['restriction'])) {
            foreach ($simpleType['restriction']['enumeration'] as $enum) {
                $enumeration = $dom->createElement('xsd:enumeration');
                $enumeration->setAttribute('value', $enum);
                $restriction->appendChild($enumeration);
            }

            $simpleTypeElement->appendChild($restriction);
        }
        $dom->documentElement->appendChild($simpleTypeElement);

        return $dom;
    }
}