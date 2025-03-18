<?php

namespace App\Farm;

class Barn
{
	private array $animals = [];

	/**
	 * @param $animal
	 */
	public function addAnimal($animal)
	{
		$this->animals[] = $animal;
	}

	/**
	 * @return array
	 */
	public function getAnimals() : array
	{
		return $this->animals;
	}
}