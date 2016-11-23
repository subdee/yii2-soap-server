<?php
declare(strict_types = 1);

namespace subdee\soapserver\tests\Controllers;

class StringSoapController
{
    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'getString' => [
                'class' => 'subdee\soapserver\SoapAction',
                'classMap' => [
                    'StringArrayModel' => '\sudbee\soapserver\tests\models\StringArrayModel',
                ],
            ],
        ];
    }

    /**
     * Simple test which returns a StringArrayModel in order to see how the wsdl pans out
     * @return \subdee\soapserver\tests\models\StringArrayModel
     * @soap
     */
    public function getRules()
    {
        return new \subdee\soapserver\tests\models\StringArrayModel();
    }
}