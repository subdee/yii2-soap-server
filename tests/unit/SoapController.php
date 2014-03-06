<?php

namespace subdee\soapserver\tests\unit;

class SoapController
{
	public $enableCsrfValidation = false;

	public function actions()
	{
		return [
			'hello' => [
				'class' => 'subdee\soapserver\SoapAction'
			],
		];
	}

	/**
	 * Returns hello and the name that you gave
	 *
	 * @param string $name Your name
	 * @return string
	 * @soap
	 */
	public function getHello($name)
	{
		return 'Hello ' . $name;
	}
}