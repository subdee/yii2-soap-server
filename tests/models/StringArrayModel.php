<?php
declare(strict_types = 1);

namespace subdee\soapserver\tests\models;

use yii\base\Model;

class StringArrayModel extends Model
{
    /**
     * @var string[] Array of string
     * @soap
     */
    public $stringParameter = [];
}