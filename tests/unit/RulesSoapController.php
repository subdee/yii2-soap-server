<?php
namespace subdee\soapserver\tests\unit;

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
                    'RulesTestModel' => RulesTestModel::class,
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