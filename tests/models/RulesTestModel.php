<?php
namespace subdee\soapserver\tests\models;

use yii\base\Model;

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
     * @var \DateTime
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
    public function rules()
    {
        return [
            ['integerValue','integer','min' => 1, 'max' => 9999],
            [['stringValue','regExpValue'],'trim'],
            ['stringValue','string','length' => [13,37]],
            ['emailValue','email', 'allowName' => true],
            ['rangeValue','in','range' => [1,2,3]],
            ['regExpValue', 'match', 'pattern' => '/[a-z]*/i'],
            ['regExpValue', 'InvalidValidator'],
            ['numberValue','number'],
            ];
    }
}