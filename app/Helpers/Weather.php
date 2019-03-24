<?php

namespace App\Helpers;

use App\Helpers\TemperatureMock;

class Weather
{
	protected $temperature;

	public function __construct(TemperatureMock $mock)
	{
		$this->temperature = $mock;
	}

	public function show()
	{
		return $this->temperature->currentTemperature();
	}
}

