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

        if (array_key_exists('restriction', $simpleType)) {
            if (array_key_exists('pattern', $simpleType['restriction'])) {
                $pattern = $dom->createElement('pattern');
                $pattern->setAttribute('value', $simpleType['restriction']['pattern']);
                $restriction->appendChild($pattern);
            }
        }
        $simpleTypeElement->appendChild($restriction);

        $dom->documentElement->appendChild($simpleTypeElement);

        return $dom;
    }
}