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

    public function rules()
    {
        return [
            ['integerValue','integer'],
            [['stringValue','regExpValue'],'trim'],
            ['stringValue','string','length' => [13,37]],
            ['rangeValue','in','range' => [1,2,3]],
            ['regExpValue', 'match', 'pattern' => '/[a-z]*/i'],
            ['regExpValue', 'InvalidValidator']
            ];
    }
}