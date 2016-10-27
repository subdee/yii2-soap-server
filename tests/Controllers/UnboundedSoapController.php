<?php
namespace subdee\soapserver\tests\Controllers;

use subdee\soapserver\tests\models\UnboundClass;

class UnboundedSoapController
{
    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'getUnbounded' => [
                'class' => 'subdee\soapserver\SoapAction',
                'classMap' => [
                    'UnboundedClass' => UnboundClass::class,
                ],
            ],
        ];
    }

    /**
     * Simple test which returns a unboundedtest
     * @return \subdee\soapserver\tests\models\UnboundedTestModel
     * @soap
     */
    public function getUnbounded()
    {
        return new \subdee\soapserver\tests\models\UnboundedTestModel();
    }
}