<?php
namespace subdee\soapserver\Validators;

abstract class SimpleType
{
    /** @var array */
    protected $data;

    /** @var  string */
    protected $xsdName;

    /**
     * ValidatorBase constructor.
     * @param $data array
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param string $xsdName
     */
    public function setXsdName($xsdName)
    {
        $this->xsdName = $xsdName;
    }

    /**
     * returns name of the class without namespacing
     * @return string
     */
    public function getName()
    {
        $classname = substr(strtolower(get_called_class()), 0, -4);
        \Codeception\Util\Debug::debug($classname);
        if ($pos = strrpos($classname, '\\'))
        {
            return substr($classname, $pos + 1);
        }
        return $pos;
    }

    /**
     * returns the data used in the creation of the wsdl
     * @return array
     */
    abstract public function generateSimpleType();
}