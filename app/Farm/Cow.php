<?php

namespace App\Farm;

class Cow extends Animal
{
	public function __construct()
	{
		parent::__construct('Корова','молоко','литров/литра/литр');

		$this->init();
	}

	private function init()
	{
		$this->setMinCollected(8);
		$this->setMaxCollected(12);
	}
}