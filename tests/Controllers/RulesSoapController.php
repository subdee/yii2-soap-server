<?php
namespace subdee\soapserver\tests\Controllers;

use subdee\soapserver\tests\models\RulesTestModel;

class RulesSoapController
{
    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'getRules' => [
                'class' => 'subdee\soapserver\SoapAction',
                'classMap' => [
                    'RulesTestModel' => '\sudbee\soapserver\tests\models\RulesTestModel',
                ],
            ],
        ];
    }

    /**
     * Simple test which returns a RulesTestModel in order to see how the wsdl pans out
     * @return \subdee\soapserver\tests\models\RulesTestModel
     * @soap
     */
    public function getRules()
    {
        return new \subdee\soapserver\tests\models\RulesTestModel();
    }
}