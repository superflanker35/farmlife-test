<?php

namespace App\Farm;

class Hen extends Animal
{
	public function __construct()
	{
		parent::__construct('Курица','яйца','шт.');

		$this->init();
	}

	private function init()
	{
		$this->setMinCollected(0);
		$this->setMaxCollected(1);
	}
}