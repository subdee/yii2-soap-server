<?php
// TODO this could be deleted
namespace subdee\soapserver\tests\unit;

use subdee\soapserver\tests\models\RulesTestModel;

class RulesSoapController
{
    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'rulestest' => [
                'class' => 'subdee\soapserver\SoapAction'
            ],
        ];
    }

    /**
     * Simple test which returns a RulesTestModel in order to see how the wsdl pans out
     * @return \subdee\soapserver\tests\models\RulesTestModel
     * @soap
     */
    public function getRulestest()
    {
        return new RulesTestModel();
    }
}