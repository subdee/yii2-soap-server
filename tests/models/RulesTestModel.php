<?php
namespace subdee\soapserver\tests\models;

use yii\base\Model;

/**
 * @description RuleTest model
 */
class RulesTestModel extends Model
{

    /**
     * @var integer
     * @soap
     */
    public $integerValue;

    /**
     * @var string
     * @soap
     */
    public $stringValue;

    /**
     * @var integer
     * @soap
     */
    public $rangeValue;

    /**
     * @var string
     * @soap
     */
    public $regExpValue;

    /**
     * @var date
     * @soap
     */
    public $dateValue;

    /**
     * @var string
     * @soap
     */
    public $emailValue;

    /**
     * @var integer
     * @soap
     */
    public $numberValue;

    /**
     * @var subdee\soapserver\tests\models\UnboundClass[] {minOccurs = 0, maxOccurs = unbounded}
     * @soap
     */
    public $unboundClass = [];

    /**
     * @var integer[]
     * @soap
     */
    public $integerArray;

    /**
     * @var string
     * @soap
     */
    public $maxLengthValue;

    /**
     * List of rules for this class
     * @return array
     */
    public function rules()
    {
        return [
            ['integerValue', 'integer', 'on' => ['wsdl'], 'min' => 1, 'max' => 9999],
            [['stringValue', 'regExpValue'], 'trim', 'on' => ['wsdl']],
            ['stringValue', 'string', 'on' => ['wsdl'], 'length' => [13, 37]],
            ['emailValue', 'email', 'on' => ['wsdl'], 'allowName' => true],
            ['rangeValue', 'in', 'on' => ['wsdl'], 'range' => [1, 2, 3]],
            ['regExpValue', 'match', 'on' => ['wsdl'], 'pattern' => '/[a-z]*/i'],
            ['regExpValue', 'InvalidValidator', 'on' => ['wsdl']],
            ['numberValue', 'number', 'on' => ['wsdl']],
            ['regExpValue', 'InvalidValidator', 'on' => ['wsdl']],
            [['dateValue'], 'date', 'on' => ['wsdl']],
            ['maxLengthValue', 'string', 'on' => ['wsdl'], 'length' => 1337],
        ];
    }
}