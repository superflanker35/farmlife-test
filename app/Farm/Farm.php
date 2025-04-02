<?php

namespace App\Farm;

class Farm
{
	private static $instance;
	private int $weekDays = 7;
	private array $regNumbers = [];
	private array $productCollectStats = [];
	private array $initialAnimals = ['Cow'=>10,'Hen'=>20];
	private Barn $barn;
	/**
	 * Farm constructor.
	 */
	private function __construct()
	{
		$this->init();
	}

	/**
	 *
	 */
	private function init()
	{
		$this->barn = new Barn();
		$this->addAnimalsToBarn($this->initialAnimals);
	}

	/**
	 * @return Farm
	 */
	public static function getInstance() : Farm
	{
		if(!isset(self::$instance)){
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @param $animalsArray
	 *
	 * @return bool
	 */
	public function addAnimalsToBarn($animalsArray) : bool
	{
		foreach($animalsArray as $key=>$value) {
			if(empty($key)){
				return false;
			}

			$animalClass = "App\\Farm\\" . $key;
			
			for($i = 0; $i<$value; $i++) {
				$animal = new $animalClass();
				$this->barn->addAnimal($animal);
				$this->regNumbers[] = $animal->getRegNumber();
			}
		}

		return true;
	}

	/**
	 * @return array
	 */
	public function collectFromBarnAnimals()
	{
		$barnAnimals = $this->barn->getAnimals();
		$result = [];

		for($i=0; $i<$this->weekDays; $i++) {
			foreach ($barnAnimals as $value) {
				$type                       = $value->getType();
				$productTypeMeasurementUnit = $value->getProductType() . ' ' . $value->getProductUnitOfMeasurement();

				if (!array_key_exists($type, $result)) {
					$result[$type][$productTypeMeasurementUnit] = $value->collect();
				} else {
					$result[$type][$productTypeMeasurementUnit] += $value->collect();
				}
			}
		}

		$this->productCollectStats[] = $result;

		return $result;
	}

	/**
	 * @return array
	 */
	public function getBarnAnimalsStats() : array
	{
		$barnAnimals = $this->barn->getAnimals();
		$result = [];

		foreach($barnAnimals as $value) {
			$type = $value->getType();

			if(!array_key_exists($type,$result)){
				$result[$type] = 1;
			}else{
				$result[$type]++;
			}
		}

		return $result;
	}

	/**
	 * @return array
	 */
	public function getRegNumbers() : array
	{
		return $this->regNumbers;
	}

	/**
	 * @return array
	 */
	public function getProductCollectStats() : array
	{
		return $this->productCollectStats;
	}
}